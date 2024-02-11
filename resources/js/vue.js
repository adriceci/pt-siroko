import {createApp} from 'vue';

// Import components
import Card from './components/Card.vue';
import Products from "./components/Products.vue";
import Login from "./components/Login.vue";
import Cart from "./components/Cart.vue";
import CartCard from "./components/CartCard.vue";

const app = createApp();

// Register components
app.component('card', Card);
app.component('products', Products);
app.component('login', Login);
app.component('cart', Cart);
app.component('cart-card', CartCard);

app.mount('#app');
