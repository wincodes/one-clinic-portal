import Vue from 'vue'

Vue.filter('displayErrors', (error) => {
  let string = "";
  error.forEach(err => {
    string = string + " " + err;
  });
  return string;
})