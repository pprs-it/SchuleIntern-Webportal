<template>
  <div class="example-simple">
    <h1 id="example-title" class="example-title">Simple Example</h1>
    <div class="upload">
      <ul>
        <li v-for="file in files" :key="file.id">
          <span>{{file.name}}</span> -
          <span>{{file.size}}</span> -
          <span v-if="file.error">{{file.error}}</span>
          <span v-else-if="file.success">success {{file.response}}</span>
          <span v-else-if="file.active">active</span>
          <span v-else-if="!!file.error">{{file.error}}</span>
          <span v-else></span>
        </li>
      </ul>
      <div class="example-btn">
        {{url}}
        <file-upload
            class="btn btn-primary"
            :post-action="url"
            extensions="gif,jpg,jpeg,png,webp"
            accept="image/png,image/gif,image/jpeg,image/webp"
            :multiple="true"
            :size="1024 * 1024 * 10"
            v-model="files"
            @input-filter="inputFilter"
            @input-file="inputFile"
            ref="upload">
          <i class="fa fa-plus"></i>
          Select files
        </file-upload>
        <button type="button" class="btn btn-success" v-if="!upload || !upload.active" @click.prevent="upload.active = true">
          <i class="fa fa-arrow-up" aria-hidden="true"></i>
          Start Upload
        </button>
        <button type="button" class="btn btn-danger"  v-else @click.prevent="upload.active = false">
          <i class="fa fa-stop" aria-hidden="true"></i>
          Stop Upload
        </button>
      </div>
    </div>
    <div class="pt-5 source-code">
      Source code: <a href="https://github.com/lian-yue/vue-upload-component/blob/master/docs/views/examples/Simple.vue">/docs/views/examples/Simple.vue</a>
    </div>
  </div>
</template>
<style>
.example-simple label.btn {
  margin-bottom: 0;
  margin-right: 1rem;
}
</style>

<script>
import {ref, watch} from 'vue'
import FileUpload from 'vue-upload-component'
export default {
  components: {
    FileUpload,
  },
  props: {
    target: String
  },
  setup(props, context) {
    console.log(props, context)


    const upload = ref(null)

    const files = ref([])


    var url = ''; //props.target;

    watch(() => {
      url = props.target;
    });

    function inputFilter(newFile, oldFile, prevent) {
      if (newFile && !oldFile) {
        // Before adding a file
        // 添加文件前

        // Filter system files or hide files
        // 过滤系统文件 和隐藏文件
        if (/(\/|^)(Thumbs\.db|desktop\.ini|\..+)$/.test(newFile.name)) {
          return prevent()
        }

        // Filter php html js file
        // 过滤 php html js 文件
        if (/\.(php5?|html?|jsx?)$/i.test(newFile.name)) {
          return prevent()
        }
      }
    }

    function inputFile(newFile, oldFile) {
      if (newFile && !oldFile) {
        // add
        //console.log('add', newFile)
      }
      if (newFile && oldFile) {
        // update
        //console.log('update', newFile)
        if (newFile.success == true) {
          //console.log(newFile.response.parentID)
          //console.log(url)
          //url = 'aaaa';
          //console.log(url)
        }
      }

      if (!newFile && oldFile) {
        // remove
        //console.log('remove', oldFile)
      }
    }



    return {
      files,
      upload,
      inputFilter,
      inputFile,
      url
    }
  }
}
</script>
