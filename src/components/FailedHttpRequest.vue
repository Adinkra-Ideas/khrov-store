<template>
  <div class="failed-http-request">
    <FadeTransition :duration="2">
      <BaseHeading variant="h2" v-if="serverIsDown">{{
        serverErrorMessage
      }}</BaseHeading>
    </FadeTransition>

    <div class="failed-http-request__timer" v-if="!isFetching">
      <base-heading variant="h3">{{ errorMessage }}</base-heading>
      <CountDownTimer :timeout="timeout" @onTimerEnd="onFetchRequest" />
      <span class="failed-http-request__status"
        >Error code: <strong>{{ errorCode }}</strong></span
      >
    </div>

    <div
      v-if="isFetching && !serverIsDown"
      class="failed-http-request__sending-request"
    >
      <base-heading variant="h3">Sending new request...</base-heading>
      <Loader />
    </div>
  </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { watch } from "@vue/runtime-core";
import CountDownTimer from "./CountDownTimer.vue";
import BaseHeading from "./UI/BaseHeading.vue";
import FadeTransition from "./UI/FadeTransition.vue";
import Loader from "./UI/Loader.vue";

const props = defineProps({
  errorMessage: {
    type: String,
    required: true,
  },
  errorCode: {
    type: Number,
    required: false,
  },
  timeout: {
    type: Number,
    required: true,
  },
  serverIsDown: {
    type: Boolean,
    required: true,
  },
  serverErrorMessage: {
    type: [null, String],
    required: true,
  },
});

const isFetching = ref(false);

const onFetchRequest = () => {
  isFetching.value = true;
};

watch(
  () => props.timeout,
  () => {
    isFetching.value = false;
  },
  { immediate: true }
);
</script>

<style scoped>
.failed-http-request {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 40px;
  position: relative;
}

.failed-http-request__timer {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
}

.failed-http-request__status {
  font-size: 20px;
  color: red;
}

.failed-http-request__sending-request {
  position: relative;
}
</style>
