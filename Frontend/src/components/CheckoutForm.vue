<template>
  <FadeTransition>
    <BaseCard>
      <BaseHeading variant="h2">Your personal data</BaseHeading>
      <div class="checkout-form">
        <BaseForm @submit.prevent="submitForm">
          <ul class="checkout-form__input-list">
            <li v-for="input in inputs" :key="input.label">
              <BaseInput
                :placeholder="input.placeholder"
                :label="input.label"
                :type="input.type"
                :name="input.name"
                :required="input.required"
                :error="formError[input?.name]"
                :value="userInput[input.name]"
                :handleChange="handleChange"
              />
            </li>
          </ul>

          <BaseButton variant="contained" type="submit" mode="success"
            >Submit</BaseButton
          >
        </BaseForm>
      </div>
    </BaseCard>
  </FadeTransition>
</template>

<script setup>
import BaseCard from "./UI/BaseCard.vue";
import BaseForm from "./UI/BaseForm.vue";
import BaseHeading from "./UI/BaseHeading.vue";
import BaseInput from "./UI/BaseInput.vue";
import BaseButton from "./UI/Buttons/BaseButton.vue";
import FadeTransition from "./UI/FadeTransition.vue";
import { INPUT_FIELDS } from "@/constants/checkoutFormInputs";
import { reactive, ref } from "@vue/reactivity";
import { useRouter } from "vue-router";
import { computed, watch } from "@vue/runtime-core";
import { useCartStore } from "@/store/useCartStore";
import { clearLocalStorare } from "@/utils/helpers";

const USER_INPUT_INIT = {
  name: "",
  phone: "",
  comment: "",
  location: "",
  email: "",
  address: "",
};

const props = defineProps({
  delivery: {
    type: [null, Object],
    required: true,
  },
  location: {
    type: [null, String],
    required: true,
  },
});

const router = useRouter();
const cartStore = useCartStore();

const inputFields = INPUT_FIELDS;
const userInput = reactive({ ...USER_INPUT_INIT });
const formError = reactive({});

const handleChange = (e) => {
  const field = e.target.name;
  const value = e.target.value;

  clearValidation(field);
  userInput[field] = value;
};

const clearValidation = (field) => {
  if (field) {
    formError[field] = "";
    return;
  }

  Object.assign(formError, {});
};

const validateForm = () => {
  let isFormValid = true;
  const isNameInputValid = userInput.name.trim().length > 2;
  const isPhoneValid =
    userInput.phone.trim().length >= 10 && userInput.phone.trim().length <= 20;

  if (!isNameInputValid || !isPhoneValid) {
    formError.name = isNameInputValid
      ? ""
      : "Name cannot be less or equal than 2 letters";
    (formError.phone = isPhoneValid
      ? ""
      : "Phone number digits range is 10-20"),
      (isFormValid = false);
  }

  return isFormValid;
};

const submitForm = () => {
  if (!validateForm()) return;

  console.log("order:", {
    id: 1,
    customer: {
      name: userInput.name,
      phone: userInput.phone,
      email: userInput.email,
      comment: userInput.comment,
    },
    products: props.cart,
    delivery: {
      ...props.delivery,
      region: userInput.location,
      address: userInput.address,
    },
  });

  router.replace("/checkout/success");
  clearLocalStorare("cart");
  cartStore.clearCart();

  Object.assign(userInput, USER_INPUT_INIT);
};

const inputs = computed(() => {
  return inputFields.filter((field) => {
    if (!props.delivery.type) return field;

    if (props.delivery.type === "pickup") {
      return field.name !== "location" && field.name !== "address";
    }

    return field;
  });
});

watch(
  () => props.location,
  () => {
    userInput.location = props.location;
  },
  { immediate: true }
);
</script>

<style>
.checkout-form {
  max-width: 100%;
}

.checkout-form__input-list {
  display: flex;
  flex-direction: column;
  gap: 8px;
  list-style: none;
  padding: 0;
}

@media screen and (min-width: 768px) {
  .checkout-form {
    max-width: 40%;
  }
}
</style>
