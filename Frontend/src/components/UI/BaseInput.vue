<template>
  <div class="base-input">
    <label for="input" class="base-input__label"
      >{{ label
      }}<span class="base-input__label-required" v-if="required">*</span></label
    >
    <input
      id="input"
      :placeholder="placeholder"
      :type="type"
      :class="['base-input__input', error ? 'base-input__input_error' : '']"
      :name="name"
      :value="value"
      @input="handleChange"
      :required="required"
    />
    <FadeTransition>
      <span class="base-input__error" v-if="error">{{ error }}</span>
    </FadeTransition>
  </div>
</template>

<script setup>
import FadeTransition from "./FadeTransition.vue";

const props = defineProps({
  label: {
    type: String,
    required: false,
  },
  placeholder: {
    type: String,
    required: true,
  },
  type: {
    type: String,
    required: true,
  },
  name: {
    type: String,
    required: false,
  },
  error: {
    type: String,
    required: false,
  },
  required: {
    type: Boolean,
    required: true,
  },
  value: {},
  handleChange: {
    type: Function,
    required: true,
  },
});
</script>

<style>
.base-input {
  display: flex;
  flex-direction: column;
  gap: 5px;
  height: 90px;
}

.base-input__label {
  align-self: flex-start;
  font-size: 16px;
  font-weight: 600;
  line-height: 22px;
  color: #333333;
}

.base-input__label-required {
  color: #ef2525;
}

.base-input__input {
  font-size: 16px;
  line-height: 20px;
  color: #222222;
  padding: 10px 20px;
  border-radius: 10px;
  border: 1px solid lightgray;
  outline: 2px solid transparent;
}

.base-input__input_error {
  transition: outline 0.3s ease-in;
  outline: 2px solid #ef2525;
}

.base-input__input::placeholder {
  font-size: 14px;
  color: lightgray;
}

.base-input__error {
  align-self: flex-start;
  font-size: 14px;
  color: #ef2525;
}
</style>
