import axios from 'axios';

export default {
  async createMail(name, mail, text) {
    return (await axios.post('/api/createMail', {
      name,
      mail,
      text
    })).data;
  },
};
