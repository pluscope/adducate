document.addEventListener('DOMContentLoaded', function () {
  var container = document.getElementsByClassName('container-expand')[0];
  if (container != null) {
    var container_height = container.offsetHeight + 100;
    container.style.height = container_height.toString(10).concat('px');
  }
});

function moveleft() {
  var container_width = document.getElementsByClassName(
    'container-body-white-left'
  )[0].offsetWidth;
  var push = document.getElementsByClassName('push');
  var pxstr = push[3].style.transform.match(/(-?\d+)/);
  if (pxstr == null) {
    push[3].style.transform = 'translateX(-170px)';
  } else {
    var px = parseInt(pxstr);
    var array_width = push[3].offsetWidth;
    if (array_width + px > container_width + 170) var newpx = px - 170;
    else var newpx = container_width - array_width;
    var newpxstr = newpx.toString(10);
    str = 'translateX('.concat(newpxstr, 'px)');
    push[3].style.transform = str;
  }
}

function moveright() {
  var push = document.getElementsByClassName('push');
  var pxstr = push[3].style.transform.match(/(-?\d+)/);
  if (pxstr != null) {
    var px = parseInt(pxstr);
    if (px < 0) var newpx = px + 170;
    else var newpx = 0;
    var newpxstr = newpx.toString(10);
    str = 'translateX('.concat(newpxstr, 'px)');
    push[3].style.transform = str;
  }
}
