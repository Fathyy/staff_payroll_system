window.onload = function(){  
    const smallButton = document.querySelector('.small-button');
    const sideBar = document.querySelector('.sidebar');
    // smallButton.onclick = function () {
    //     sideBar.classList.toggle("toggled");
    // };

    smallButton.addEventListener('click', () => {
    sideBar.classList.toggle("toggled");
    });

    // 
    // const smallButton = document.querySelector('#small-button');
    // const sideBar = document.querySelector('#sidebar');

    // smallButton.addEventListener('click', () => {
    //     sideBar.style.visibility="visible";
    // })
};

