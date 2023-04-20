<template>
  <div class="preloader-bg">
    <div class="lds-dual-ring"></div>
  </div>
</template>

<script>
export default {
  name: "PreloaderComponent"
}
</script>

<style scoped>

.preloader-bg {
  z-index: 100;
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  opacity: .7;
  background-color: rgba(0, 0, 0, 1);
}


.loading {
  font-family: quantico, sans-serif;
  font-weight: 800;
  display: inline-block;
  position: absolute;
  top: 59%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-transform: uppercase;
  text-shadow: 0 0 9px rgba(37, 146, 238, .9), 0 0 9px rgba(37, 146, 238, .9), 0 0 9px rgba(37, 146, 238, .9);

}

.lds-dual-ring {
  display: inline-block;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 80px;
  height: 80px;
}

.lds-dual-ring:after {
  content: " ";
  display: block;
  width: 64px;
  height: 64px;
  margin: 8px;
  border-radius: 50%;
  border: 6px solid;
  border-color: rgba(37, 146, 238, .9) transparent rgba(37, 146, 238, .9) transparent;
  animation: lds-dual-ring 0.6s linear infinite;

}

@keyframes lds-dual-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

</style>
