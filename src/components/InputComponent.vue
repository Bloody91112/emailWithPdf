<template>
  <div class="field">
    <input :name="name" type="text">
    <label>{{ label }}</label>
  </div>
</template>

<script>
export default {
  props: {
    name: {
      type: String,
      default: null
    },
    label: {
      type: String,
      default: null
    }
  },
  name: "InputComponent"
}
</script>

<style scoped>

</style>