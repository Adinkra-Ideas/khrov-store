import { ref } from 'vue' ;

export const useHomePageComposable = () => {
  // **********************************************************
  // This variable is used by Quasar carousel to determine if *
  // slides will be autplayed or not.                         *
  // When its value is true, slides will be auto played.      *
  // When its value is false, slide autoplaying will stop.    *
  // **********************************************************
  const autoplay = ref<boolean>(true) ;

  // ********************************************************
  // This variable is used by Quasar carousel as v-model.   *
  // Its values should be integer. When autoplaying or      *
  // next slide is clicked, the carousel auto increment     *
  // the integer value of this variable by 1 and the slide  *
  // whose :name="N" number correspond to the current value *
  // will be displayed.                                     *
  // ********************************************************
  const slide = ref<number>(0) ;

  return {
    autoplay,
    slide,   
  }
}
