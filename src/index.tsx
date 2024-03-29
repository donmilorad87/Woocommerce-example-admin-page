import {addFilter} from '@wordpress/hooks';
import {__} from '@wordpress/i18n';
import {ExampleReactHook} from "./ExampleReactHook/ExampleReactHook";



addFilter('woocommerce_admin_pages_list', 'wc-admin-example-page', (pages) => {

    pages.push( {
        container: ExampleReactHook,
        path: '/example',
        breadcrumbs: [ __( 'My Example Page', 'wc-admin-example-page' ) ],
        navArgs: {
            id: 'my-example-page',
            parentPath: '/woocommerce',
        },
    } );

    return pages;

});
