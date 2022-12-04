<template>
  <router-view />
  <!-- Manage night mode toggle -->
  <div
    class="cursor-pointer fixed-bottom-left q-ml-md q-mb-md"
    style="font-size:2em;"
    @click="$q.dark.toggle()"
  >
    <q-icon
      v-if="!$q.dark.isActive"
      name="nights_stay"
    />
    <q-icon
      v-if="$q.dark.isActive"
      name="light_mode"
    />
  </div>
</template>

<script setup lang="ts">
  import { useQuasar } from 'quasar'

  const $q = useQuasar()

</script>
