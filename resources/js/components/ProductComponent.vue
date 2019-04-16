<template>
    <div>
        <div class="product-filter">
            <div class="row">
                <div class="col-md-4 col-sm-5">
                    <div class="btn-group">
                        <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
                        <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
                    </div>
                </div>
                <div class="col-sm-2 text-right">
                    <label class="control-label" for="input-sort">مرتب سازی :</label>
                </div>
                <div class="col-md-3 col-sm-4 text-right">
                    <select id="input-sort" class="form-control col-sm-8" v-model="sort" @change="getSortedProduct()">

                        <option value="ASC">قیمت (کم به زیاد)</option>
                        <option value="DESC">قیمت (زیاد به کم)</option>

                    </select>
                </div>
                <div class="col-sm-1 text-right">
                    <label class="control-label" for="input-limit" >نمایش :</label>
                </div>
                <div class="col-sm-2 text-right">
                    <select id="input-limit" class="form-control" v-model="paginate" @change = "getSortedProduct()">
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                    </select>
                </div>
            </div>
        </div>
        <br />
        <div class="row products-category">
            <div class="product-layout product-grid col-lg-3 col-md-3" v-for="product in products.data">
                <div class="product-thumb clearfix">
                    <div class="image"><a :href="'http://kharidchi.test:10/products/'+product.slug"><img :src="'http://kharidchi.test:10/' +product.photos[0].path" alt="تی شرت کتان مردانه" title="تی شرت کتان مردانه" class="img-responsive" /></a></div>
                    <div class="caption">
                        <h4><a :href="'http://kharidchi.test:10/products/'+product.slug">{{product.title}}</a></h4>
                        <p class="price" v-if="product.discount_price"><span class="price-new">{{product.discount_price}} تومان</span> <span class="price-old">{{product.price}} تومان </span><span class="saving">{{Math.round(((product.price-product.discount_price)/product.price)*100)}}%</span></p>
                        <p class="price" v-if="!product.discount_price">{{product.price}} تومان </p>
                    </div>
                    <div class="button-group">
                        <a class="btn-primary" :href="'http://kharidchi.test:10/add-product-to-cart/'+ product.id" ><span>افزودن به سبد</span></a>
                    </div>
                </div>

            </div>
        </div>
        <div class="row" v-if="products.last_page">
            <div class="col-sm-12 text-center">
                <paginate
                        v-model="page"
                        :page-count="products.last_page"
                        :page-range="3"
                        :margin-pages="2"
                        :click-handler="clickCallback"
                        :prev-text="'قبلی'"
                        :next-text="'بعدی'"
                        :container-class="'pagination'"
                        :page-class="'page-item'">
                </paginate>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                products:[],
                sort: 'DESC',
                page:1,
                paginate:2
            }
        },
        props: ['category'],
        mounted(){
            axios.get('/api/products/'+ this.category.id ).then(res=>{
                this.paginate=res.data.products
                this.products=res.data.products
            }).catch(err=>{
                console.log(err)
            })
        },
        methods: {
            clickCallback: function(pageNum){
                this.products=[];
                if(this.flag){
                    this.getFilterProduct();
                }
                else if(this.sort === "ASC" || this.sort === "DESC"){
                    this.getSortedProduct()
                }else{
                    axios.get('/api/products/' + this.category.id +'?page='+ pageNum).then(res =>{
                        this.products = res.data.products
                    }).catch(err=>{
                        console.log (err)
                    })
                }
            },
            getSortedProduct:function () {
                this.products=[];
                axios.get('/api/sort-products/' + this.category.id + '/' + this.sort +'/' +this.paginate+ '?page=' + this.page ).then(res=>{
                    this.products=res.data.products
                }).catch(err=>{
                    console.log(err)
                })
            }

        }
    }
</script>
