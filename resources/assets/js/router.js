import ExhibitView from './components/ExhibitViewComponent.vue';
import EditView from './components/EditViewComponent.vue';
import CreateView from './components/CreateViewComponent.vue';

export default router => {
    router.map({
        '/home' : {
            name : 'home',
            component :  ExhibitView 
        },
        '/create' : {
            name : 'create',
            component: { CreateView }
        },
        '/edit/:id' : {
            component : { EditView }
        }
    });
};