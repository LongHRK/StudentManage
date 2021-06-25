function changeMenu(e, id) {
    var menuitem = document.getElementsByClassName("menu-item");
    [].forEach.call(menuitem,function(element){
      element.classList.remove("active");
    });
    e.target.classList.add("active");

    var contentitem = document.getElementsByClassName("content-item");
    [].forEach.call(contentitem,function(element){
      element.classList.remove("active");
    });
    var contenActive = document.getElementById("content-" + id);
    contenActive.classList.add("active");
  }