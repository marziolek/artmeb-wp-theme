var container;

var camera, scene, renderer, controls;

var INTERSECTED, particleMaterial;

var mouseX = 0, mouseY = 0;

var progressIndicator = $('#progress-indicator');

var clock = new THREE.Clock();

//raycasting for selection init
var mouseVector  = new THREE.Vector3(),
    mouseVector1  = new THREE.Vector3(),
    projector = new THREE.Projector(),
    raycastered,pickedObject;

var canvasH = $('#model3d').height(),
    canvasW = $('#model3d').width(),
    windowHalfX = canvasW / 2,
    windowHalfY = canvasH / 2;

var defaultMaterial = new THREE.MeshPhongMaterial({
  shininess: 0,
  color: 0x8f8f8f
});

var legsMaterial = new THREE.MeshPhongMaterial({
  shininess: 90,
  color: 0x4f4f4f,
  specular: 0xdedede
});

init();
animate();

//INIT INIT INIT INIT INIT INIT INIT INIT INIT INIT INIT INIT INIT INIT INIT INIT INIT INIT INIT

function init() {

  renderer = new THREE.WebGLRenderer( { alpha: true, antialias: true } );
  renderer.setClearColor( 0xFFFFFF, 1 );
  renderer.setPixelRatio( window.devicePixelRatio );
  renderer.setSize( canvasW, canvasH );
  renderer.shadowMap.enabled = true;
  renderer.shadowMap.type = THREE.PCFSoftShadowMap;
  container = document.getElementById('model3d');
  container.appendChild( renderer.domElement );


  raycastered = new THREE.Raycaster();

  /* / controls */

  camera = new THREE.PerspectiveCamera( 45, canvasW / canvasH, 1, 2000 );
  camera.position.z = 200;
  camera.position.y = 50;
  controls = new THREE.OrbitControls( camera ,renderer.domElement);
  controls.enablePan = false;
  controls.enableZoom = false;
  controls.target.set( 0, 10, 0 );

  //camera click zoom in/out
  var zoomInBtn = document.querySelector('.js-zoom-in'),
      zoomOutBtn = document.querySelector('.js-zoom-out');

  function zoomCamera(moveDistance){
    var YAXIS = new THREE.Vector3(0, 1, 0);
    var ZAXIS = new THREE.Vector3(0, 0, 1);
    var direction = ZAXIS.clone();
    direction.applyQuaternion(camera.quaternion);
    direction.sub(YAXIS.clone().multiplyScalar(direction.dot(YAXIS)));
    direction.normalize();
    camera.quaternion.setFromUnitVectors(ZAXIS, direction);
    camera.translateZ(-moveDistance);

  }

  zoomInBtn.addEventListener('click',function(){
    zoomCamera(5);
  },false);

  zoomOutBtn.addEventListener('click',function(){
    zoomCamera(-5);
  },false);

  // scene
  scene = new THREE.Scene();

  var light = new THREE.HemisphereLight( 0xffffbb, 0x080820, 1 );
  var spotLight = new THREE.SpotLight( 0xFFFEBC );
  spotLight.castShadow = true;
  spotLight.shadow.mapSize.width = 2048;
  spotLight.shadow.mapSize.height = 2048;
  spotLight.intensity = 0.8;
  spotLight.shadow.camera.near = 650;
  spotLight.shadow.camera.far = 1000;
  spotLight.shadow.camera.fov = 30;
  spotLight.position.set(-500,500,500);
  scene.add( spotLight );
  var spotLightFill = new THREE.SpotLight( 0xFBE4FF );
  spotLightFill.castShadow = true;
  spotLightFill.intensity = 0.4;
  spotLightFill.shadow.mapSize.width = 2048;
  spotLightFill.shadow.mapSize.height = 2048;
  spotLightFill.shadow.camera.near = 650;
  spotLightFill.shadow.camera.far = 1000;
  spotLightFill.shadow.camera.fov = 30;
  spotLightFill.position.set(300,500,600);
  scene.add( spotLightFill );
  var spotLightEdge = new THREE.SpotLight( 0xA4BDCC );
  spotLightEdge.castShadow = true;
  spotLightEdge.intensity = 0.5;
  spotLightEdge.shadow.mapSize.width = 2048;
  spotLightEdge.shadow.mapSize.height = 2048;
  spotLightEdge.shadow.camera.near = 500;
  spotLightEdge.shadow.camera.far = 700;
  spotLightEdge.shadow.camera.fov = 40;
  spotLightEdge.position.set(-200,100,-300);
  scene.add( spotLightEdge );
  //scene.add( light );


  //camera helper

  //	var cameraHelper = new THREE.CameraHelper(camera);
  //	var shadowCameraHelper = new THREE.CameraHelper(spotLightFill.shadow.camera);
  //var shadowCameraHelper = new THREE.CameraHelper(spotLight.shadow.camera);
  //	var shadowCameraHelper = new THREE.CameraHelper(spotLightEdge.shadow.camera);
  //	scene.add(cameraHelper);
  //scene.add(shadowCameraHelper);

  //spotlight helper

  //	var spotLightHelper = new THREE.SpotLightHelper(spotLightFill, 50); // 50 is sphere size

  //	scene.add(spotLightHelper);


  //LOAD MANAGER LOAD MANAGER LOAD MANAGER LOAD MANAGER LOAD MANAGER LOAD MANAGER LOAD MANAGER LOAD MANAGER LOAD MANAGER LOAD MANAGER

  var manager = new THREE.LoadingManager();
  manager.onProgress = function ( item, loaded, total ) {
    console.log( item, loaded, total );
  };

  var texture = new THREE.Texture();

  var onProgress = function ( xhr ) {
    if ( xhr.lengthComputable ) {
      var percentComplete = xhr.loaded / xhr.total * 100,
          percentageShow = Math.round(percentComplete, 2);

      progressIndicator.removeClass('hide');
      progressIndicator.find('.text').text(percentageShow + '%');
      if (percentageShow >= 100) {
        progressIndicator.addClass('hide');
      }
    }
  };

  var onError = function ( xhr ) {
  };

  //LOAD TEXTURE LOAD TEXTURE LOAD TEXTURE LOAD TEXTURE LOAD TEXTURE LOAD TEXTURE LOAD TEXTURE LOAD TEXTURE LOAD TEXTURE LOAD TEXTURE

  var material;
  var loader = new THREE.ImageLoader( manager );

  changeMaterials(manager, loader, texture);

  //LOAD MODEL LOAD MODEL LOAD MODEL LOAD MODEL LOAD MODEL LOAD MODEL LOAD MODEL LOAD MODEL LOAD MODEL LOAD MODEL LOAD MODEL LOAD MODEL

  var loader = new THREE.OBJLoader( manager );

  loader.load( themeUrl + '/3D/' + 'obj/fotel.obj', function ( object ) {
    object.traverse( function ( child ) {
      if ( child instanceof THREE.Mesh && child.name.split("_")[1] != "nogi" ) {
        child.material = defaultMaterial;
      } else {
        child.material = legsMaterial;
      }
    } );

    object.position.y = -10;
    object.castShadow = true;
    object.receiveShadow = true;
    object.name = "fotel";
    scene.add( object );
  }, onProgress, onError );

  //ADD FLOOR ADD FLOOR ADD FLOOR ADD FLOOR ADD FLOOR ADD FLOOR

  /*var floor,floorMaterial,floorTexture,floorHeightMap;
  floorTexture = new THREE.TextureLoader().load( themeUrl + '/3D/' + 'textures/woodPlanks.jpg');
  floorHeightMap = new THREE.TextureLoader().load( themeUrl + '/3D/' + 'textures/woodPlanks-bumpMap.jpg');
  floorTexture.wrapS = THREE.RepeatWrapping;
  floorTexture.wrapT = THREE.RepeatWrapping;
  floorHeightMap.wrapS = floorHeightMap.wrapT = THREE.RepeatWrapping;
  floorHeightMap.repeat.set(4,4);
  floorTexture.repeat.set(4,4);
  floorMaterial = new THREE.MeshPhongMaterial({
    map: floorTexture,
    bumpMap: floorHeightMap,
    bumpScale:0.5,
    shininess: 0.1
  });
  floor = new THREE.Mesh(new THREE.PlaneGeometry(400,400),floorMaterial);
  floor.receiveShadow = true;
  floor.material.side = THREE.DoubleSide;
  floor.position.x = -20;
  floor.position.y = -10;
  floor.rotation.x = Math.PI/2;
  floor.name = 'floor';*/
  //scene.add(floor); //hide floor for now


  changeModel(manager);
  window.addEventListener( 'resize', onWindowResize, false );

  //selecting object on click listener
  container.addEventListener('mousedown', onMouseDown,false);
  //container.addEventListener('mousemove', onMouseMove,false);
}

//ON RESIZE ON RESIZE ON RESIZE ON RESIZE ON RESIZE ON RESIZE ON RESIZE ON RESIZE ON RESIZE ON RESIZE ON RESIZE ON RESIZE ON RESIZE ON RESIZE ON RESIZE
function onWindowResize() {

  windowHalfX = canvasW / 2;
  windowHalfY = canvasH / 2;

  camera.aspect = canvasW / canvasH;
  camera.updateProjectionMatrix();

  renderer.setSize( canvasW, canvasH );

}

//ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE
function animate() {
  controls.update();
  requestAnimationFrame( animate );
  render();
}

//RENDER RENDER RENDER RENDER RENDER RENDER RENDER RENDER RENDER RENDER RENDER RENDER RENDER RENDER RENDER RENDER RENDER RENDER
function render() {
  renderer.render( scene, camera );
}

//MATERIAL SWITCHER MATERIAL SWITCHER MATERIAL SWITCHER MATERIAL SWITCHER MATERIAL SWITCHER MATERIAL SWITCHER MATERIAL SWITCHER

function changeMaterials(manager) {
  $('.materials [data-image]').click( function() {
    progressIndicator.removeClass('hide');
    progressIndicator.find('.text').hide();
    
    var loader = new THREE.TextureLoader(),
        newMaterial,
        isFullObject = document.getElementById('input-full-object').checked,
        hasBumpMap = $(this).data('heightmap') != undefined ? true : false;

    if(hasBumpMap){
      var heightMap = loader.load($(this).data('heightmap'), null, onProgress, onError);
      heightMap.wrapS = heightMap.wrapT = THREE.RepeatWrapping;
    }

    loader.load($(this).data('image'), function(texture) {
      texture.wrapS = THREE.RepeatWrapping;
      texture.wrapT = THREE.RepeatWrapping;

      texture.repeat.set( 19, 19 );

      if(hasBumpMap){
        newMaterial = new THREE.MeshPhongMaterial({
          map: texture,
          bumpMap: heightMap,
          bumpScale: 0.2,
          shininess: 5
        });
      } else {
        newMaterial = new THREE.MeshPhongMaterial({
          map: texture
        });
      };

      if (!isFullObject) {
        for(var i=0; i<scene.children.length;i++){
          var child = scene.children[i];

          if(child.type == "Group"){
            for(var j=0;child.children.length > j;j++){
              if(child.children[j].name.split("_")[1] != "nogi") {
                child.children[j].material = newMaterial;
              }
            }
          }
        }
      } else {
        if (pickedObject != undefined) {
          pickedObject.material = newMaterial;
          pickedObject.scale.set(1,1,1);
          pickedObject = null;
        }
      }
      
      progressIndicator.addClass('hide');
      progressIndicator.find('.text').show();
    });
  });
}

//SELECT ON CLICK SELECT ON CLICK SELECT ON CLICK SELECT ON CLICK SELECT ON CLICK SELECT ON CLICK SELECT ON CLICK SELECT ON CLICK SELECT ON CLICK
var scaled = false;
var windowW = $(window).width(),
    windowH = $(window).height();

function onMouseDown(event){
  event.preventDefault();

  //mouseVector.x = 2* (event.clientX / windowW) - 1;
  //mouseVector.y = 1 - 2 *(event.clientY / windowH);
  mouseVector1.x = ( (event.clientX - $(renderer.domElement).offset().left) / renderer.domElement.clientWidth ) * 2 - 1;
  mouseVector1.y = - ( (event.clientY  - $(renderer.domElement).offset().top + $(window).scrollTop()) / renderer.domElement.clientHeight ) * 2 + 1;
  //  console.log(- ( (event.clientY + $(window).scrollTop()) / renderer.domElement.clientHeight ) * 2 + 1);

  raycastered.setFromCamera(mouseVector1.clone(),camera);
  var intersects = raycastered.intersectObjects(scene.children,true),
      legsSelected = intersects[0] != undefined && intersects[0].object.name.split("_")[1]  == 'nogi' ? true : false;

  if(intersects.length > 0 && !legsSelected ){
    if(!scaled || pickedObject == undefined){
      intersects[0].object.scale.set(1.2,1.2,1.2);
      scaled = true;
      pickedObject = intersects[0].object;
    } else {
      intersects[0].object.scale.set(1,1,1);
      scaled = false;
      pickedObject = null;
    }
  }
}

//MODEL SWITCHER MODEL SWITCHER MODEL SWITCHER MODEL SWITCHER MODEL SWITCHER MODEL SWITCHER

function changeModel(manager, currentObj) {
  var btnModel = $('.model3d-switch-item'),
      manager = new THREE.LoadingManager(),
      texture = new THREE.Texture(),
      onProgress = function ( xhr ) {
        if ( xhr.lengthComputable ) {
          var percentComplete = xhr.loaded / xhr.total * 100,
              percentageShow = Math.round(percentComplete, 2);

          progressIndicator.removeClass('hide');
          progressIndicator.find('.text').text(percentageShow + '%');
          if (percentageShow >= 100) {
            progressIndicator.addClass('hide');
          }
        }
      },
      onError = function ( xhr ) {};

  var loader = new THREE.OBJLoader();

  btnModel.click( function() {
    var self = $(this),
        newModelName = self.data('model'),
        canvasWrapper = $('#model3d'),
        oldModelName = canvasWrapper.attr('data-model-current'),
        oldModel = scene.getObjectByName(oldModelName);

    self.addClass('active').siblings().removeClass('active');

    scene.remove(oldModel);
    canvasWrapper.attr('data-model-current', newModelName);
    loader.load( themeUrl + '/3D/' + 'obj/' + newModelName + '.obj', function ( object ) {
      object.traverse( function ( child ) {

        if ( child instanceof THREE.Mesh ) {
          if ( child instanceof THREE.Mesh && child.name.split("_")[1] != "nogi" ) {
            child.material = defaultMaterial;
          } else {
            child.material = legsMaterial;
          }
        }
      } );

      object.position.y = -10;
      object.castShadow = true;
      object.receiveShadow = true;
      object.name = newModelName;
      scene.add( object );
    }, onProgress, onError );
  });
}

window.requestAnimationFrame(render);