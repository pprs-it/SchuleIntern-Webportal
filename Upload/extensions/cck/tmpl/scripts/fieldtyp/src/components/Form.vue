<template>

  <div class="si-form">

    <ul class="">
      <li :class="required">
        <label>Titel</label>
        <input v-model="item.title" />
      </li>

      <li >
        <label>Template</label>
        <input v-model="item.template" />
      </li>

      <li>
        <button @click="submitForm" class="si-btn"><i class="fa fa-save"></i> Speichern</button>
      </li>
    </ul>
  </div>

</template>


<script>
import User from "../mixins/User.vue";
import UserSelect from '../mixins/UserSelect.vue'

export default {
  components: {
    User, UserSelect
  },
  name: 'Form',
  props: {
    item: Object
  },
  data(){
    return {

      error: false,
      required: ''
    }
  },
  created: function () {
  },
  mounted() {
    // access our input using template refs, then focus
  },
  methods: {


    submitForm: function () {
      var that = this;
      //this.form.date = this.$date(this.form.date).format('YYYY-MM-DD')

      if (!this.item.template) {
        this.item.template = '';
      }
      if (!this.item.title) {
        console.log('missing');
        this.required = 'required';
        return false;
      }

      EventBus.$emit('form--submit', {
        item: that.item
      });

    }

  }
}
</script>
