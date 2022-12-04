<template>
  <form autocomplete="off" class="form" novalidate>
    <slot></slot>
  </form>
</template>

<style>
.form {
  display: flex;
  flex-direction: column;
  gap: 40px;
}
</style>