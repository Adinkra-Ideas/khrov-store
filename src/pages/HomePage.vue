<script setup lang="ts">
  import { useHomePageComposable } from 'src/composables/HomePageComposable' ;

  const {
    autoplay,
    slide,
    
  } = useHomePageComposable() ;
  
</script>

<template>
  <q-page>
    <div class="q-ma-md q-pa-lg rounded-borders bg-teal-1" style="height:80vh;">
      <q-carousel
        animated
        v-model="slide"
        infinite
        :autoplay="autoplay"
        transition-prev="slide-right"
        transition-next="slide-left"
        @mousedown="autoplay = false"
        @mouseleave="autoplay = true"
      >
        <q-carousel-slide :name="0" class="bg-teal-1">
          <div>
            <div class="text-h6 text-uppercase text-center">
              Notice of End of Service
            </div>
            <div class="text-body1 q-mt-sm">
              <p>
                Dear ZhouMail User,
              </p>
            </div>
            <div class="text-body2">
              <p>
                ZhouMail email service has been discontinued on November 30, 2023. <br /><br />
                Existing email users still have access to their selected inbox messages.
              </p>
            </div>
            <div>
              <q-btn 
                :label="'Existing Email Login'" 
                color="deep-orange" 
                class="glossy q-mb-lg"
                @click="$router.push({ path: '/mail' })" 
              /> 
            </div>
          </div>
        </q-carousel-slide>

        <q-carousel-slide :name="1" img-src="login_top_with_bg.png" />

      </q-carousel>
    </div>
  </q-page>
</template>
