import HomeComponent from "@component/HomeComponent.vue";
import CatalogComponent from "@component/CatalogComponent.vue";
import BookDetailComponent from "@component/BookDetailComponent.vue";
import AddBookComponent from "@component/AddBookComponent.vue";

const routes = [
    {
        path: '/',
        component: HomeComponent,
        meta: {title: 'Home | Boooooooks'}
    },
    {
        path: '/catalog',
        component: CatalogComponent,
        meta: {title: 'Catalog | Boooooooks'},
    },
    {
        path: '/book/:id',
        component: BookDetailComponent,
    },
    {
        path: '/add-book/',
        component: AddBookComponent,
    },
];

export default routes;
