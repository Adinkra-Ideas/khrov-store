<template>
  <q-layout view="hHh lpr fff">
    <q-header elevated class="bg-purple glossy">
      <q-toolbar>
        <q-btn flat round dense icon="img:logo.png" style="font-size:2em;" />
        <q-space />
        <q-select
          v-model="locale"
          :options="localeOptions"
          dense
          borderless
          emit-value
          map-options
        >
          <template v-slot:selected-item="scope">
            <q-chip
              @remove="scope.removeAtIndex(scope.index)"
              :tabindex="scope.tabindex"
              text-color="secondary"
              class="q-ma-none"
            >
              <q-avatar :icon="scope.opt.icon" />
              {{ scope.opt.label }}
            </q-chip>
          </template>
        </q-select>
      </q-toolbar>
    </q-header>
    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script setup lang="ts">
  import { useI18n } from 'vue-i18n'

  // locale is for selecting which language pack from src/i18n to use
  // t is for picking the named key from inside the selected language pack src/i18n in use
  const { locale } = useI18n({ useScope: 'global' })
  const localeOptions = [
        { value: 'cn', label: 'Chinese', icon: 'img:cn.svg' },
        { value: 'en-US', label: 'English', icon: 'img:gb.svg' },
        { value: 'de', label: 'German', icon: 'img:de.svg' },
        { value: 'in', label: 'Hindi', icon: 'img:in.svg' },
        { value: 'jp', label: 'Japanese', icon: 'img:jp.svg' },
        { value: 'ru', label: 'Russian', icon: 'img:ru.svg' },
        { value: 'ke', label: 'Swahili', icon: 'img:ke.svg' },
      ]
</script>
