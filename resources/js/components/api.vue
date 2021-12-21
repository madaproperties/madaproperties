<template>
  <div>
    Api Component - {{name}}
    <input type="text" v-model="name" />
    <button @click="api()">Click Me </button>
  </div>
</template>

<script>
    export default{
      data(){
        return {
          name: 'ahmed',
        }
      },
      methods: {
        api: function (){
          axios.get('api/search/'+this.name).then(res => {
              console.log(res);
          });
        },

      }
    }
</script>
