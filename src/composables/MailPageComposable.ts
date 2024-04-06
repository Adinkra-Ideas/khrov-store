import { reactive, ref } from 'vue' ;

export const useMailPageComposable = () => {
  // ******************************************************
  // msgListOrBody is used to toggle between which div to *
  // display between the div holding the email summary    *
  // listings vs the div holding the email message of the *
  // email that is active.                                * 
  // The div holding the email summary will be displayed  *
  // when msgListOrBody===true, else the other will be.   *
  // ******************************************************
  const msgListOrBody = ref<boolean>(true) ;

  // ********************************************************************
  // activeEmail reactive object holds the email that is being viewed.  *
  // ********************************************************************
  interface ActiveEmail {
    senderName: string
    senderEmail: string
    date: string
    initials: string
    subject: string
    body: string    
  } ;
  const activeEmail: ActiveEmail = reactive({
    senderName: '',
    senderEmail: '',
    date: '',
    initials: '',
    subject: '',
    body: '',
  }) ;

  // **********************************************************************************
  // convertNameToInitial() takes a string that contains two names separated by space *
  // char. Then it converts this string to a two char name initials using the First   *
  // char of first name and last name but if no space char is found,it just picks the *
  // first two chars of the string.                                                   *
  // **********************************************************************************
  const convertNameToInitial = (name: string): string => {
    let initial = name.charAt(0) ;
    const posOfSpaceChar = name.indexOf(' ') ;
    
    // ************************************************************************
    // Get Char after space character, else get second character if no space  *
    // character found in 'name' variable.                                    *
    // ************************************************************************ 
    initial += (posOfSpaceChar !== -1) ? name.charAt(posOfSpaceChar + 1) : name.charAt(1) ;

    return initial ;
  }


  return {
    msgListOrBody,
    activeEmail,
    convertNameToInitial,   

  }
}
