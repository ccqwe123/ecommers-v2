<template>
    <div class="container-fluid">
        <div class="invoice p-3 m-3">
          <div class="row">
            <div class="col-md-12">
              <h4>
                <i class="fas fa-store"></i> Main Banner
              </h4>
            </div>
            <div class="col-md-12 mt-3">
                <div class="callout callout-warning">
              <h5><i class="fas fa-info"></i> Note:</h5>
              Recommend size: 1170 x 500
            </div>
            </div>
          </div>
            
            <div class="row">
            <div class="col-md-4">
                <form @submit.prevent="createBanner()">
                    <div class="form-group">
                        <select class="form-control" v-model="form.slide_number" @change="styleChange($event)">
                            <option value="" disabled>Select Slide No.</option>
                            <option value="1">Slide 1</option>
                            <option value="2">Slide 2</option>
                            <option value="3">Slide 3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="bstyle" v-model="form.bstyle" id="slide-1" value="1">
                            <label class="form-check-label" for="slide-1">Style A</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="bstyle" v-model="form.bstyle" id="slide-2" value="2">
                            <label class="form-check-label" for="slide-2">Style B</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="bstyle" v-model="form.bstyle" id="slide-3" value="3">
                            <label class="form-check-label" for="slide-3">Style C</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input v-model="form.text_one" type="text" name="text_one" placeholder="First Text" class="form-control" :class="{ 'is-invalid': form.errors.has('text_one') }">
                    </div>
                    <div class="form-group">
                        <input v-model="form.text_two" type="text" name="text_two" placeholder="Second Text" class="form-control" :class="{ 'is-invalid': form.errors.has('text_two') }">
                    </div>
                    <div class="form-group">
                        <input v-model="form.text_third" type="text" name="text_third" placeholder="Third Text" class="form-control" :class="{ 'is-invalid': form.errors.has('text_third') }">
                    </div>
                    <div class="form-group">
                        <input v-model="form.text_fourth" type="text" name="text_fourth" placeholder="Fourth Text" class="form-control" :class="{ 'is-invalid': form.errors.has('text_fourth') }">
                    </div>
                    <div class="form-group">
                        <input type="file" name="banner_image" class="input-file form-control" @change="onFileChange" accept="image/*">
                    </div>
                    <button class="btn btn-success btn-block">Save</button>
                </form>
            </div>
            <div class="col-md-8">
               <div class="wrap-main-slide">
                <label>Preview:</label>
                <div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
                    <div class="item-slide" v-if="form.bstyle == 1">
                        <!-- <img src="/images/banner/main-slider-1-1.jpg" alt="" class="img-slide" v-if="url" :src="url"> -->
                        <!-- <img :src="getBannerPhoto()"alt="" class="img-slide" v-else> -->
                        <img :src="getBannerPhoto()"alt="" class="img-slide">
                        <div class="slide-info slide-1">
                            <h2 class="f-title">{{ form.text_one}} <b>{{ form.text_two}}</b></h2>
                            <span class="subtitle">{{ form.text_third}}</span>
                            <p class="sale-info">Only price: <span class="price">₱{{ form.text_fourth }}</span></p>
                            <a href="#" class="btn-link">Shop Now</a>
                        </div>
                    </div>
                    <div class="item-slide" v-if="form.bstyle == 2">
                        <!-- <img src="/images/banner/main-slider-1-2.jpg" alt="" class="img-slide" v-if="url" :src="url"> -->
                        <!-- <img src="/images/banner/main-slider-1-2.jpg" alt="" class="img-slide" v-else> -->
                        <img :src="getBannerPhoto()" alt="" class="img-slide">
                        <div class="slide-info slide-2">
                            <h2 class="f-title">{{ form.text_one}} </h2>
                            <span class="f-subtitle">{{ form.text_two}} </span>
                            <!-- <p class="discount-code">Use Code: #FA6868</p> -->
                            <h4 class="s-title">{{ form.text_third}}</h4>
                            <p class="s-subtitle">{{ form.text_fourth}}</p>
                        </div>
                    </div>
                    <div class="item-slide" v-if="form.bstyle == 3">
                        <!-- <img src="/images/banner/main-slider-1-3.jpg" alt="" class="img-slide" v-if="url" :src="url"> -->
                        <!-- <img src="/images/banner/main-slider-1-3.jpg" alt="" class="img-slide" v-else> -->
                        <img :src="getBannerPhoto()" alt="" class="img-slide">
                        <div class="slide-info slide-3">
                            <h2 class="f-title">{{ form.text_one}} <b>{{ form.text_two}}</b></h2>
                            <span class="f-subtitle">{{ form.text_third}}</span>
                            <p class="sale-info">Stating at: <b class="price">{{ form.text_fourth}}</b></p>
                            <a href="#" class="btn-link">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
          </div>
        </div>
    </div>
</template>
<style type="text/css" scoped>
    .btn-link{
        background: #ff2832 !important;
    }
    .item-slide{
        width: 100% !important;
    }
    img
    {
        border: 2px solid;
    }
    .wrap-main-slide .slide-carousel .slide-info.slide-1
    {
        top:40%;
        left:35%;
    }
  /*  .wrap-main-slide .slide-1 .f-title b {
        color: #222222;
        font-size: 38px;
        font-weight: 700;
    }
    .wrap-main-slide .slide-1 .f-title {
        font-size: 25px !important;
        line-height: 23.8px !important;
    }*/
</style>
<script>
    import datatable from 'datatables.net-bs4'
    export default {
       data(){
            return {
                form: new Form({
                    bstyle:'slide-1',
                    text_one:'',
                    text_two:'',
                    text_third:'',
                    text_fourth:'',
                    slide_number:'',
                    image_banner: '',
                }),
                url: null,
                loading: true,
            }
        },
        mounted() {
            
            this.loadBanner();
            this.getBannerPhoto();
        },
        methods: {
            getBannerPhoto()
            {
                let img = (this.form.image_banner.length > 200) ? this.form.image_banner : "images/banner/"+ this.form.image_banner;
                console.log(img);
                return img;
            },
            onFileChange(e)
            {
                const file = e.target.files[0];
                let reader = new FileReader();
                this.url = URL.createObjectURL(file);
                console.log(file);
                reader.onloadend = (file) => {
                    this.form.image_banner = reader.result;
                }
                reader.readAsDataURL(file);
            },
            loadBanner() {
                 axios.get("api/banners?slide=1")
                    .then(response => {
                        this.form.fill(response.data);
                    });
            },
            createBanner()
            {
               this.form.post('api/banners')
                .then(response => {
                    this.loadBanner();
                    toast.fire({
                      icon: 'success',
                      title: 'Banner Successfully Updated'
                    })
                })
            },
            styleChange(event)
            {
                // console.log(event.target.value);
                axios.get("api/banners?slide="+event.target.value)
                    .then(response => {
                        console.log(response.data);
                        this.form.fill(response.data);
                    });
            }
        }
    }
</script>