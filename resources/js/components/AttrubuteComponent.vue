<template>
    <div>
        <div class="form-group">
            <label>دسته بندی</label>
            <select name="categories[]" id="" class="form-control"  multiple="true" v-model="categories_selected" @change="onChange($event)">
                <option v-for="category in categories" :value="category.id">{{category.name}}</option>
            </select>
        </div>
        <div v-if="flag">
            <div class="form-group" v-for="(attribute,index) in attributes">
                <label>ویژگی {{ attribute.title }}</label>
                <select  class="form-control" @change="addAttribute($event,index)">
                    <option>انتخاب کنید...</option>
                    <option v-if="!product" v-for="attributeValue in attribute.attributes_value" :value="attributeValue.id">{{attributeValue.title}}</option>
                    <option v-if="product"  v-for="attributeValue in attribute.attributes_value" :value="attributeValue.id" :selected=" product.attribute_values[index].id=== attributeValue.id">{{attributeValue.title}}</option>                </select>

            </div>
        </div>
        <input type="hidden" name="attributes[]" :value="computedAttribute">
        <div class="form-group">
            <label>برند</label>
            <select name="brand" class="form-control">
                <option>انتخاب کنید...</option>
                <option v-if="!product" v-for="brand in brands" :value="brand.id" >{{brand.title}}</option>
                <option v-if="product" v-for="brand in brands" :value="brand.id" :selected="product.brand.id === brand.id">{{brand.title}}</option>
            </select>
        </div>
   </div>
</template>

<script>
    export default {

        data() {
            return {
                categories: [],
                categories_selected: [],
                flag: false,
                attributes: [],
                selectedAttribute:[],
                computedAttribute:[],
            }
        },
        props: ['brands','product'],
        mounted() {
            axios.get('/api/categories').then(res => {
                this.getAllChildren(res.data.categories, 0)
            }).catch(err => {
                console.log(err)
            })
            if(this.product){
                for(var i=0; i<this.product.categories.length; i++){
                   this.categories_selected.push(this.product.categories[i].id)
                }
                this.onChange();
            }
        },
        methods: {
            getAllChildren: function (currentValue, level) {
                for (var i = 0; i < currentValue.length; i++) {
                    var current = currentValue[i];
                    this.categories.push({
                        id: current.id,
                        name: Array(level + 1).join("--- ") + " " + current.name
                    })
                    if (current.children_recursive && current.children_recursive.length > 0) {
                        this.getAllChildren(current.children_recursive, level + 1)
                    }
                }
            },
            onChange: function () {
                this.flag=false;
                axios.post('/api/categories/attribute' ,this.categories_selected).then(res=>{
                    this.attributes = res.data.attributes
                    this.flag = true
                }).catch(err => {
                        console.log(err)
                        this.flag = false;
                    })
            },
            addAttribute:function (event,index) {
                for (var i=0;i<this.selectedAttribute.length;i++){
                  var current=this.selectedAttribute[i];
                  if (current.index=== index){
                      this.selectedAttribute.splice(i,1)
                  }
                }

                this.selectedAttribute.push({
                    'index':index,
                    'value':event.target.value
                })
                this.computedAttribute=[]
                for (var j=0;j<this.selectedAttribute.length;j++){
                    this.computedAttribute.push(this.selectedAttribute[j].value)

                }

            }
        }
    }

</script>
