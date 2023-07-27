/* eslint-disable no-undef */

import Freeform from '@components/front-end/plugin/freeform';

class BackButton {
  form;

  constructor(freeform) {
    this.form = freeform.form;
    this.reload();
  }

  reload = () => {
    const backButtons = this.form.querySelectorAll(`*[name=${Freeform._BACK_BUTTON_NAME}]`);
    for (let i = 0; i < backButtons.length; i++) {
      const button = backButtons[i];
      button.addEventListener('click', () => {
        const back = document.createElement('input');
        back.type = 'hidden';
        back.name = Freeform._BACK_BUTTON_NAME;
        back.value = '';
        this.form.appendChild(back);
      });
    }
  };
}

export default BackButton;
