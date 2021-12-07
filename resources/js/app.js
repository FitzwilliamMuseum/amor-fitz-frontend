/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('accordion-link', require('./components/AccordionLink.vue').default);
Vue.component('avatar-background', require('./components/AvatarBackground.vue').default);
Vue.component('avatar-item', require('./components/AvatarItem.vue').default);
Vue.component('break-points', require('./components/BreakPoints.vue').default);
Vue.component('button-hayley', require('./components/Button.vue').default);
Vue.component('button-link', require('./components/ButtonLink.vue').default);
Vue.component('colour-palette', require('./components/ColourPalette.vue').default);
Vue.component('correspondence-card', require('./components/CorrespondenceCard.vue').default);
Vue.component('correspondence-card-front', require('./components/CorrespondenceCardFront.vue').default);
Vue.component('correspondence-header', require('./components/CorrespondenceHeader.vue').default);
Vue.component('correspondence-list', require('./components/CorrespondenceList.vue').default);
Vue.component('cta-card', require('./components/CTACard.vue').default);
Vue.component('dropdown-selector', require('./components/DropdownSelector.vue').default);
Vue.component('entity-card', require('./components/EntityCard.vue').default);
Vue.component('entity-header', require('./components/EntityHeader.vue').default);
Vue.component('entity-list', require('./components/EntityList.vue').default);
Vue.component('entity-list-card', require('./components/EntityListCard.vue').default);
Vue.component('entity-paginate', require('./components/EntityPaginate.vue').default);
Vue.component('icon', require('./components/Icon.vue').default);
Vue.component('letter-list', require('./components/LetterList.vue').default);
Vue.component('letter-preview-card', require('./components/LetterPreviewCard.vue').default);
Vue.component('letter-viewer', require('./components/LetterViewer.vue').default);
Vue.component('number-bullet', require('./components/NumberBullet.vue').default);
Vue.component('pagination', require('./components/Pagination.vue').default);
Vue.component('breadcrumbs', require('./components/TheBreadcrumbs.vue').default);
Vue.component('the-header', require('./components/TheHeader.vue').default);
Vue.component('leaflet-map', require('./components/Map.vue').default);
Vue.component('tag', require('./components/Tag.vue').default);
Vue.component('tag-list', require('./components/TagList.vue').default);
Vue.component('leaflet-geojson', require('./components/GeoJsonMap.vue').default)
Vue.component('team-profile-card', require('./components/TeamProfileCard.vue').default)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
