<template>
    <label :id="'file-' + name" class="input-file">
      <input  type="file" :name="name">
      <span>{{ label }}</span>
    </label>
</template>

<script>
export default {
  name: "InputFileComponent",
  props: {
    name: {
      default: null,
      type: String,
    },
    label: {
      default: null,
      type: String,
    },
  },
  mounted() {
    let block = document.querySelector('#file-' + this.name)
    let input = block.querySelector('input')
    let label = block.querySelector('span')
    input.addEventListener('change', function(e){
      let file = e.target.files[0];
      label.innerHTML = file.name;
    })
  }
}
</script>

<style scoped>
.input-file {
  margin: 15px 0;
  position: relative;
  display: block;
}
.input-file span {
  position: relative;
  display: inline-block;
  cursor: pointer;
  outline: none;
  text-decoration: none;
  font-size: 14px;
  vertical-align: middle;
  color: rgb(255 255 255);
  text-align: center;
  border-radius: 20px;
  background: linear-gradient(-135deg, #c850c0, #4158d0);
  line-height: 22px;
  height: 40px;
  padding: 10px 20px;
  box-sizing: border-box;
  border: none;
  margin: 0;
  transition: background-color 0.2s;
}
.input-file input[type=file] {
  position: absolute;
  z-index: -1;
  opacity: 0;
  display: block;
  width: 0;
  height: 0;
}

/* Focus */
.input-file input[type=file]:focus + span {
  box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

/* Hover/active */
.input-file:hover span {
  background-color: #59be6e;
}
.input-file:active span {
  background-color: #2E703A;
}

/* Disabled */
.input-file input[type=file]:disabled + span {
  background: linear-gradient(-135deg, #c850c0, #4158d0);
}
</style>