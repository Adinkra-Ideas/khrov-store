<script setup lang="ts">
  interface Props {
    senderName: string,
    date: string,
    subject: string, 
  }
  // Using 'const props' as in this example is necessary when we want to access
  // the props variable inside the script section of this component.
  // const props = withDefaults(defineProps<Props>(), {
  // });
  withDefaults(defineProps<Props>(), {
  });

</script>

<template>
  <tr class="cursor-pointer">
    <td class="text-left text-weight-bold">{{ senderName }}</td>
    <td class="text-left">{{ subject }}</td>
    <td class="text-right"><q-icon name="drafts" class="q-mx-sm" />{{ date }}</td>
  </tr>
</template>
