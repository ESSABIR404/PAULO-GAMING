const hamburger= document.querySelector('.header .nav-bar .nav-list .hamburger');
const mobil_menu =document.querySelector('.header .nav-bar .nav-list ul');
const header=document.querySelector('header.container');

hamburger.addEventListener('click',()=>{
    hamburger.classList.toggle('active');
    mobil_menu.classList.toggle('active');
});
document.addEventListener('scroll',()=>{
    var scroll_position =window.scrollY;
    if(scroll_position>250){
        header.computedStyleMap.backgroundColor='#29323c';
    }
    else{
        header.computedStyleMap.backgroundColor='transparent';
    }
})