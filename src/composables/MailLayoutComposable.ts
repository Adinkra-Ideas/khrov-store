import { ref } from 'vue' ;

export const useMailLayoutComposable = () => {
  // ************************************************************************
  // leftDrawerOpen is used for v-model of <q-drawer side="left">.          *
  // When the value is true, <q-drawer side="left"> AKA left sidebar        *
  // will be visible, else when the value is false, <q-drawer side="left">  *
  // will be hidden.                                                        *
  // ************************************************************************
  const leftDrawerOpen = ref<boolean>(false) ;

  // *************************************************************
  // toggleLeftDrawer() function is used to toggle the value of  *
  // leftDrawerOpen to true and false.                           *
  // This function is connected to the @click="" event on the    *
  // hamburger icon to the left of the header                    *
  // *************************************************************
  const toggleLeftDrawer = () => {
    leftDrawerOpen.value = !leftDrawerOpen.value
  } 
  return {
    leftDrawerOpen,
    toggleLeftDrawer   
  }
}
