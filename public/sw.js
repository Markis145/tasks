importScripts("/service-worker/precache-manifest.d53a82a3ccd8eda8436393d6dac05b0e.js", "https://storage.googleapis.com/workbox-cdn/releases/4.1.0/workbox-sw.js");

workbox.setConfig({
  debug: true
})

workbox.core.skipWaiting()
workbox.core.clientsClaim()
// workbox.core.skipWaiting()
// workbox.core.clientsClaim()
workbox.precaching.cleanupOutdatedCaches()

workbox.precaching.precacheAndRoute(self.__precacheManifest)

const showNotification = () => {
  self.registration.showNotification('Post Sent', {
    body: 'You are back online and your post was successfully sent!'
    // icon: 'assets/icon/256.png',
    // badge: 'assets/icon/32png.png'
  })
}

const bgSyncPlugin = new workbox.backgroundSync.Plugin('newsletter', {
  maxRetentionTime: 24 * 60, // Retry for max of 24 Hours
  callbacks: {
    queueDidReplay: showNotification
  }
})

workbox.routing.registerRoute(
  '/api/v1/newsletter',
  new workbox.strategies.NetworkOnly({
    plugins: [bgSyncPlugin]
  }),
  'POST'
)

workbox.routing.registerRoute(
  new RegExp('.(?:jpg|jpeg|png|gif|svg|webp)$'),
  workbox.strategies.cacheFirst({
    cacheName: 'images',
    plugins: [
      new workbox.expiration.Plugin({
        maxEntries: 20,
        purgeOnQuotaError: true
      })
    ]
  })
)

workbox.routing.registerRoute(
  '/',
  new workbox.strategies.StaleWhileRevalidate({ cacheName: 'landing' })
)

workbox.routing.registerRoute(
  '/public/css/*',
  new workbox.strategies.StaleWhileRevalidate({ cacheName: 'css' })
)

workbox.routing.registerRoute(
  '/public/favicon-32x32',
  new workbox.strategies.CacheFirst({ cacheName: 'favicon' })
)

workbox.routing.registerRoute(
  new RegExp('/tasques'),
  new workbox.strategies.NetworkFirst()
)

const WebPush = {
  init () {
    self.addEventListener('push', this.notificationPush.bind(this))
    self.addEventListener('notificationclick', this.notificationClick.bind(this))
    self.addEventListener('notificationclose', this.notificationClose.bind(this))
  },

  /**
   * Handle notification push event.
   *
   * https://developer.mozilla.org/en-US/docs/Web/Events/push
   *
   * @param {NotificationEvent} event
   */
  notificationPush (event) {
    if (!(self.Notification && self.Notification.permission === 'granted')) {
      return
    }

    // https://developer.mozilla.org/en-US/docs/Web/API/PushMessageData
    if (event.data) {
      event.waitUntil(
        this.sendNotification(event.data.json())
      )
    }
  },
  /**
   * Handle notification click event.
   *
   * https://developer.mozilla.org/en-US/docs/Web/Events/notificationclick
   *
   * @param {NotificationEvent} event
   */
  notificationClick (event) {
    // console.log(event.notification)
    if (event.action === 'some_action') {
      // Do something...
      // TODO
    } else {
      self.clients.openWindow('/')
    }
  },

  /**
   * Handle notification close event (Chrome 50+, Firefox 55+).
   *
   * https://developer.mozilla.org/en-US/docs/Web/API/ServiceWorkerGlobalScope/onnotificationclose
   *
   * @param {NotificationEvent} event
   */
  notificationClose (event) {
    self.registration.pushManager.getSubscription().then(subscription => {
      if (subscription) {
        this.dismissNotification(event, subscription)
      }
    })
  },

  /**
   * Send notification to the user.
   *
   * https://developer.mozilla.org/en-US/docs/Web/API/ServiceWorkerRegistration/showNotification
   *
   * @param {PushMessageData|Object} data
   */
  sendNotification (data) {
    return self.registration.showNotification(data.title, data)
  },

  /**
   * Send request to server to dismiss a notification.
   *
   * @param  {NotificationEvent} event
   * @param  {String} subscription.endpoint
   * @return {Response}
   */
  dismissNotification ({ notification }, { endpoint }) {
    console.log('dismissNotification triggered!')
    if (!notification.data || !notification.data.id) {
      return
    }

    const data = new FormData()
    data.append('endpoint', endpoint)

    // Send a request to the server to mark the notification as read.
    fetch(`/api/v1/unread_notifications/${notification.data.id}`, {
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      },
      method: 'POST',
      body: data
    })
  }
}
WebPush.init()

