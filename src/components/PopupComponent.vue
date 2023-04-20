<template>
  <div style="display: none" id="popup" class="overlay">
    <div class="popup">
      <h2>Message</h2>
      <a @click="close" class="close" href="#">&times;</a>
      <div class="content">
        {{ message }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    message: {
      type: String,
      default: null
    },
    status: {
      type: Boolean,
      default: false
    }
  },
  data(){
    return {
      messageLocal: this.message,
      statusLocal: this.status,
    }
  },
  methods:{
    close(){
      let popup = document.querySelector('#popup')
      popup.style.display = 'none'
    }
  },
  name: "PopupComponent"
}
</script>

<style scoped>
.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  z-index: 100;
}

.popup {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 30%;
  position: relative;
  transition: all 5s ease-in-out;
}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: #06D85F;
}
.popup .content {
  max-height: 30%;
  overflow: auto;
}

@media screen and (max-width: 700px){
  .popup{
    width: 70%;
  }
}
</style>