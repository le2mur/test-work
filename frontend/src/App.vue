<template>
  <div id="app">
    <label>Имя: <input type="text" @input="setName($event.target.value)" :value="name"></label>

    <label>E-mail:
      <input type="email" @input="setEmail($event.target.value)" :value="email">
    </label>

    <label>
      <textarea placeholder="Текст сообщения"
                @input="setText($event.target.value)" :value="text">
      </textarea>
    </label>

    <label>
      <input type="checkbox" v-model="privacyPolicyChecked">
      Даю согласие на обработку персональных данных.
    </label>

    <label v-show="!queryInProcess">
      <button type="button" @click="submitForm">Отправить</button>
    </label>
    <label v-show="queryInProcess">
      <button type="button" disabled>Запрос в процессе выполнения</button>
    </label>
  </div>
</template>

<script>
  import api from './api';

  export default {
    name: 'App',
    data() {
      return {
        name: '',
        email: '',
        text: '',
        privacyPolicyChecked: true,
        queryInProcess: false
      };
    },

    methods: {
      setEmail(email) {
        this.email = email;
      },

      setName(name) {
        this.name = name;
      },

      setText(text) {
        this.text = text;
      },

      async submitForm() {
        if (this.allowFormSubmit) {
          try {
            this.queryInProcess = true;
            await api.createMail(this.name, this.email, this.text);
            alert('Операция прошла успешно!');
            this.reset();
          } catch {
            alert('Произошла ошибка!');
          } finally {
            this.queryInProcess = false;
          }
        } else {
          this.showNotification();
        }
      },

      showNotification() {
        if (this.name === '') {
          alert('Введите имя.');
          return;
        }

        if (this.email === '') {
          alert('Введите email.');
          return;
        }

        if (!this.privacyPolicyChecked) {
          alert('Дайте согласие на обработку персональных данных.');
        }
      },

      reset() {
        this.name = '';
        this.email = '';
        this.text = '';
      }
    },

    computed: {
      allowFormSubmit() {
        return this.email !== '' && this.name !== '' && this.privacyPolicyChecked;
      },
    },
  };
</script>

<style>
  html, body {
    height: 100%;
  }

  #app {
    display: flex;
    flex-direction: column;
    width: 400px;
    border: 1px solid;
    margin: 50px auto;
    align-items: center;
  }

  #app label {
    margin: 10px;
  }

  textarea {
    width: 210px;
    max-width: 375px;
  }
</style>