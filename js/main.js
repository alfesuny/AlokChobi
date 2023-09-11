//----------------------- Start image slider -------------------------//
var my___Index = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  my___Index++;
  if (my___Index > x.length) {my___Index = 1}    
  x[my___Index-1].style.display = "block";  
  setTimeout(carousel, 2000); // Change image every 2 seconds
}
//--------------------- End image slider ----------------------//

//--------------------- Hambarger Icone for TAV ----------------------//
const navItems = document.querySelector('.nav__items');
const openNavBtn = document.querySelector('#open__nav-btn');
const closeNavBtn = document.querySelector('#close__nav-btn');

//Open nav dropdown
const openNav = () => {
  navItems.style.display = 'flex';
  openNavBtn.style.display = 'none';
  closeNavBtn.style.display = 'inline-block';
}

//Close nav dropdown
const closeNav = () => {
  navItems.style.display = 'none';
  openNavBtn.style.display = 'inline-block';
  closeNavBtn.style.display = 'none';
}

openNavBtn.addEventListener('click', openNav);
closeNavBtn.addEventListener('click', closeNav);
//--------------------- End Hambarger ----------------------//

//--------------------- Start Start Manage Categori for mobile ----------------------//
const sidebar = document.querySelector('aside');
const showSidebarBtn = document.querySelector('#show__sidebar-btn');
const hideSidebarBtn = document.querySelector('#hide__sidebar-btn');

//shows sidebar
const showSidebar = () => {
  sidebar.style.left = '0';
  showSidebarBtn.style.display = 'none';
  hideSidebarBtn.style.display = 'inline-block';
}

//hide sidebar
const hideSidebar = () => {
  sidebar.style.left = '-100%';
  showSidebarBtn.style.display = 'inline-block';
  hideSidebarBtn.style.display = 'none';
}

showSidebarBtn.addEventListener('click', showSidebar);
hideSidebarBtn.addEventListener('click', hideSidebar);
//--------------------- End Start Manage Categori ----------------------//
