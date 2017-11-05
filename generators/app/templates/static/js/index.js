import 'style/style.scss';
import HomePage from 'pages/HomePage';

$(document).ready(() => {
    const hello = 'Hello world';
    console.log(hello);

    const homePage = new HomePage();
});