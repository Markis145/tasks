import { expect } from 'chai'
import { shallowMount } from '@vue/test-utils'
import tasks from '../../../resources/js/components/Tasks.vue'

describe('tasks.vue', () => {
  it('todo', () => {
    const wrapper = shallowMount(tasks)
    // expect(wrapper.text()).to.include(msg)
  })
})
