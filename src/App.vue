<template>
  <div class="wrapper">
    <PopupComponent :message="message"/>
    <Transition name="fade">
      <PreloaderComponent v-if="loading"/>
    </Transition>
    <div class="title">Форма</div>
    <form @submit="submitHandler($event)" action="#" enctype='multipart/form-data'>
      <h2>Информация о выполненных услугах</h2>
      <InputComponent name="executor_act_id" label="Номер акта"/>
      <InputComponent name="document_date" label="Дата документа"/>
      <InputComponent name="performer" label="Исполнитель"/>
      <InputComponent name="service_title" label="Наименование услуги"/>
      <InputComponent name="price" label="Стоимость работ"/>
      <InputFileComponent name="logo" label="Загрузите логотип" />

      <h2>Информация об исполнителе</h2>
      <InputComponent name="executor_company_title" label="Название компании исполнителя"/>
      <InputComponent name="executor_email" label="Email исполнителя"/>
      <InputComponent name="executor_inn" label="ИНН исполнителя"/>
      <InputComponent name="executor_kpp" label="КПП исполнителя"/>
      <InputComponent name="executor_address" label="Адрес исполнителя"/>
      <InputComponent name="executor_account" label="Расчетный счет исполнителя"/>
      <InputComponent name="executor_account_kor" label="Корр. счет исполнителя"/>
      <InputComponent name="executor_bank_title" label="Наименование банка исполнителя"/>
      <InputComponent name="executor_bik" label="БИК банка исполнителя"/>
      <InputComponent name="executor_phone" label="Телефон исполнителя"/>
      <InputComponent name="executor_fio" label="ФИО для подписи исполнителя"/>
      <InputFileComponent name="executor_signature" label="Загрузка подписи исполнителя" />
      <InputFileComponent name="executor_seal" label="Загрузка печати исполнителя" />

      <h2>Информация о заказчике</h2>
      <InputComponent name="customer_company_title" label="Название компании заказчика"/>
      <InputComponent name="customer_email" label="Email заказчика"/>
      <InputComponent name="customer_inn" label="ИНН заказчика"/>
      <InputComponent name="customer_kpp" label="КПП заказчика"/>
      <InputComponent name="customer_address" label="Адрес заказчика"/>
      <InputComponent name="customer_account" label="Расчетный счет заказчика"/>
      <InputComponent name="customer_account_kor" label="Корр. счет заказчика"/>
      <InputComponent name="customer_bank_title" label="Наименование банка заказчика"/>
      <InputComponent name="customer_bik" label="БИК банка заказчика"/>
      <InputComponent name="customer_phone" label="Телефон заказчика"/>
      <InputComponent name="customer_fio" label="ФИО для подписи заказчика"/>
      <InputFileComponent name="customer_signature" label="Загрузка подписи заказчика" />
      <InputFileComponent name="customer_seal" label="Загрузка печати заказчика" />

      <div class="field">
        <input type="submit" value="Подтвердить">
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";
import PreloaderComponent from "./components/PreloaderComponent.vue";
import PopupComponent from "./components/PopupComponent.vue";
import InputComponent from "./components/InputComponent.vue";
import InputFileComponent from "./components/InputFileComponent.vue";
export default {
  name: "App.vue",
  components: {
    InputFileComponent,
    InputComponent,
    PopupComponent,
    PreloaderComponent
  },
  data(){
    return {
      host: 'http://server.local',
      loading: false,
      message: null,
    }
  },
  mounted() {
    //axios.get( this.host +'/users/2').then( res => console.log(res))
    //axios.put( this.host +'/users/2').then( res => console.log(res))
    //axios.post( this.host +'/users').then( res => console.log(res))
    //axios.delete( this.host +'/users/2').then( res => console.log(res))
  },
  methods: {
    submitHandler(e){
      e.preventDefault()
      const formData = new FormData(e.target)
      this.loading = true;

      document.querySelectorAll('.error').forEach(e => e.remove());

      axios.post( this.host, formData)
          .then( (res) => {
            if (res.data.errors && res.data.errors.length > 0){
              for (const error of res.data.errors) {
                const input = document.querySelector(`input[name=${error.field}]`)
                input.parentElement.insertAdjacentHTML('afterend', `<span class="error">${error.reason}</span>`);
              }
            } else {
              this.message = res.data.message
              let popup = document.querySelector('#popup')
              popup.style.display = 'block'
            }

            this.loading = false;
          })
    }
  }
}
</script>

<style>

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.error{
  color: red;
  font-weight: bold;
}
</style>