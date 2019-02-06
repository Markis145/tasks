# Recordatori de Tasques MP7

## Drop area
- TODO -> millorar la interfície de pujada de fitxers

## Empty states
- [X] No Mostrar datatables quan no hi ha cap tasca al sistema
  - [X] Mostrar més aviat quelcom més similar a una welcome Page
  - [X] Tres items:
    - [X] Imatge SVG 
    - [X] Text gran (simpàtic i esxpliqui que cal fer)
    - [X] Botó CTA 
    - [ ] Opcional: background opcions: color paleta de grisos, patro, algun pattern de fons parcial 

## Refactoritzacions

- Moure als seus propis components parts del layout principal:
  - [X] component pel nemú de navegació de l'esquerra

## Menu seleccionat Actiu

- [X] Utilitzar tècnica "discreta" de colorejar un border (el dret) amb un color accent
- Cal abans refactoritzar la vista app.blade.php per crear un nou component
- [X] Opcional: canviar el color de les icones per que no siguin negres. FET per Vuetify
- [X] Color de les lletres un gris molt fos en comptes de negre
- [ ] Que funcioni amb submenus
## Profile usuari

- Settings: permetre canviar el color primary com a mínim (pràctica simple utilitzar LocalStorage)
  - [X] "Selector de tema" / Theme Selector
  
# Manifest.json i PWA
- [ ] Colors i icones al manifest de la system bar i de la barra de navegació 
- [X] Add to Home Screen: Service Worker simple i comprovar la instal·lació a mobils 
  
# Background colors
    
- [X] Utilitzar l'escala de grisos que hem definit per substituir algun fons blanc
- Es pot utilitzar un gradient com a scool: 
  - https://github.com/acacha/scool/blob/master/resources/views/tenants/layouts/app.blade.php
  
  style="background: #F0F4F8;background: -webkit-linear-gradient(to right, #F0F4F8, #D9E2EC, #BCCCDC);
              background: linear-gradient(to right, #F0F4F8, #D9E2EC, #BCCCDC);"
              
##US/UI i estils

- [X] No utilitzar color roig als botons acció eliminar que tenen una opció de confirmació de l'acció. Si tenen confirmació no són tant perillosos
  - [X] Aplicar jerarquia per NO destacar el botó acció d'esborrar (secondari o terciari com a mínim)
- [X] Sí utilitzar botó roig al menú de confirmació on realment s'elimina el recurs
- [X] Botons cancel: terciaris arreu

CARDS:
- [X] Vista mòbil les tasques han de ser una card cada tasca:
 - Utilitzar font-weigth en comptes de mides de lletra o semantiques h1, h2, p per fer jerarquia:
  • A normal font weight (400 or 500 depending on the font) for most text
  • A heavier font weight (600 or 700) for text you want to emphasize
- [ ] Elevation: provar la elevation
  
TIPOGRAFIA:  
- [X] Colors de lletres en escala de grisos
  - A dark color for primary content (like the headline of an article)
  - A grey for secondary content (like the date an article was published)
  - A lighter grey for tertiary content (maybe the copyright notice in a footer)
  
FAVICON i altres icones 2:
- MASTER:140x140pixels Exemple: https://realfavicongenerator.net/files/aa721752ab56d736bb190769232caefe50591992/master_favicon_thumbnail.png
- Utilitzar

# Landing Page

- [X] Incorporar alguna icona/logo/branding a la Landing Page
- [X] Favicon. Utilitzar favicon generator
- [X] Escollir una imatge de les webs de imatges d'stock mirant que siguin el més adient possible
- [X] Augmentar les mides dels textos de la pàgina principal usnat la tipografia de vue
- [X] Instal·lar altres fonts de Google (veure exemples al document Font recommendations) per als heading i titols destacats
  - Moltes fonts són de pagament. https://1stwebdesigner.com/top-google-webfonts-header-text/
  - Roboto black
- [X] Adaptar la imatge per tenir millor contrast amb les lletres
  - [X] Incorporar sombra a les lletres
  - Apartat text needs consistent contrast
    - Overlay: http://jsfiddle.net/VsHyD/
    - Opacity: 0.5;
    - .v-parallax__image-container
# Imatges de fons

## Component Gallery

Hi han exemples al document component Gallery -> Apartat Marketing page Heroes

## Stock images

- https://www.pexels.com/
- https://unsplash.com/

## Escollir fonts especials per a textos grans

Vegeu document Font Recommendations (pdf)

## Add an overlay (Pàg 117)

- Problema: escriure text sobre fotos i es vegi correctament: https://registre.lanparty.iesebre.com/

Solucions:
- Semitransparent background a la imatge

## Screenshots

- [ ] De la mida adequada, per exemple fer captures de screenshots al mòbil per ensenyar a la landing Page
- [ ] Utilitzar Remote Devices de Chrome per fer captures de pantalla de la app al mòbil

# Seccions de la Landing Page

## Testimonials
- [ ] Llista d'usuaris i fotos al twitter (per exemple) amb el que han dit de la nostra aplicació
  - https://laracasts.com/  com exemple
  
## Footer

- Footer ample, no un simple Footer 
- Que posar:
  - [ ] Qüestions secundaries
  - [ ] Pot haver-hi però un altre cop algun CTA prou important com recollir emails per mantenir-se informa't
  - [ ] Site map / About section / Social media icons / Legal
  - [ ] Copyright
  - [ ] Altres
   - [ ] FAQ/Testimonials
- Exemple:
  - https://laracasts.com/  

  - [X] notification.onclick -> developer.mozilla -> a les notificacions
  
  