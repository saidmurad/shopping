//admin components
import adminHome from "./components/admin/AdminHome";
import editItem from "./components/admin/EditItem";
import editItemInCategory from "./components/admin/EditItemInCategory";
import editCategory from "./components/admin/EditCategory";
import viewCustomers from "./components/admin/ViewCustomers";
import adminViewCategory from "./components/admin/Categories";
import itemsInSelectedCategory from "./components/admin/ItemsInSelectedCategory";
import userDetail from "./components/admin/UserDetail";
import viewOrders from "./components/admin/ViewOrders";
import viewOrderedItem from "./components/admin/ViewOrderedItem";

//customer components
import customerHome from "./components/customer/CustomerHome";
import customerViewCategory from "./components/customer/Categories";
import cartItems from "./components/customer/cartItems";
import profile from "./components/customer/Profile";
import editProfile from "./components/customer/EditProfile";

import categoryItems from "./components/Edit";
import items from "./components/customer/ItemsInSelectedCategory";
import qrcode from "./components/customer/Qrcode";
import barcode from "./components/admin/Barcode";

export default {
    mode: "history",

    routes: [
        // {
        //     path: '/home',
        //     component: profile
        // },

        {
            path: "/customerHome",
            component: customerHome
        },
    
        {
            path: "/adminHome",
            component: adminHome
        },


        {
            path: "/editItem",
            component: editItem
        },

        {
            path: "/editItemInCategory/:id",
            component: editItemInCategory
        },

        {
            path: "/editCategory",
            component: editCategory
        },

        {
            path: "/viewOrderedItem",
            component: viewOrderedItem
        },

        {
            path: "/viewCustomers",
            component: viewCustomers
        },

        {
            path: "/adminViewCategory",
            component: adminViewCategory
        },

        {
            path: "/itemsInSelectedCategory/:id",
            component: itemsInSelectedCategory
        },

        {
            path: "/categoryItems/:id",
            component: categoryItems
        },

        {
            path: "/Items/:id",
            component: items
        },

        {
            path: "/customerViewCategory",
            component: customerViewCategory,
            name: "customerViewCategory"
        },

        {
            path: "/userDetail",
            component: userDetail
        },

        {
            path: "/viewOrders",
            component: viewOrders
        },

        {
            path: "/cartItems",
            component: cartItems
        },

        {
            path: "/qrcode",
            component: qrcode
        },
        {
            path: "/barcode",
            component: barcode
        },
        {
            path: "/profile",
            component: profile
        },
        {
            path: "/editProfile",
            component: editProfile
        }
    ]
};
