<template>
  <TheHeader />
  <TheMain />
  <TheFooter />
</template>

<script setup>
import TheFooter from "./components/TheFooter.vue";
import TheHeader from "./components/TheHeader.vue";
import TheMain from "./components/TheMain.vue";
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Nunito:wght@700&family=Open+Sans:wght@400;600&display=swap");

* {
  margin: 0;
}

body {
  font-family: "Open Sans", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #222222;
}

#app {
  min-width: 320px;
  max-width: 1280px;
  margin: 0 auto;
  display: grid;
  grid-template-rows: 120px minmax(calc(100vh - 240px), auto) 120px;
  padding: 0 10px;
  box-sizing: border-box;
}

@media screen and (min-width: 768px) {
  #app {
    padding: 0 20px;
  }
}

@media screen and (min-width: 1280px) {
  #app {
    padding: 0;
  }
}
</style>
