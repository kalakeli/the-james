<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

              <div class="row">
                        <div class="col-12">
                          <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">Beer Styles according to
                                <a href="https://www.brewersassociation.org/resources/brewers-association-beer-style-guidelines/" target="_blank">
                                    Brewers Association
                                </a>
                              </h3>

                              <div class="card-tools">
                                <div class="input-group input-group-sm" style="width:50px;">
                                  <router-link to="/beerstyle" class="nav-link">
                                    <button type="button" class="btn btn-block btn-primary" title="add new item">
                                      <i class="fas fa-plus-circle"></i>
                                    </button>
                                  </router-link>
                                </div>
                              </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                              <table class="table table-hover">
                                <tbody><tr>
                                  <th>ID</th>
                                  <th>Ale Style</th>
                                  <th>Color</th>
                                  <th>Perceived Malt Aroma & Flavor</th>
                                  <th>Perceived Hop Aroma & Flavor</th>
                                  <th>Perceived Bitterness</th>
                                  <th>IBU <br><small>(low)</small> </th>
                                  <th>IBU <br><small>(top)</small></th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                </tr>
                                <tr v-for="style in beerStyles" :key="style.id">
                                  <td>{{ style.id }}</td>
                                  <td>{{ style.beerStyle }}</td>
                                  <td>{{ style.beerColor }}</td>
                                  <td>{{ style.malts }}</td>
                                  <td>{{ style.hops }}</td>
                                  <td>{{ style.bitterness }}</td>
                                  <td>{{ style.ibu_from }}</td>
                                  <td>{{ style.ibu_top }}</td>
                                  <td>
                                    <router-link :to="`/beerstyle/${style.id}`">
                                      <button type="button" class="btn btn-block btn-success" name="editStyle" title="edit item">
                                        <i class="fas fa-edit"></i>
                                      </button>
                                    </router-link>
                                  </td>
                                  <td><button type="button" class="btn btn-block btn-danger" name="deleteStyle" title="delete item" @click="deleteStyle(style.id)">
                                    <i class="fas fa-trash-alt"></i>
                                  </button> </td>
                                </tr>

                              </tbody></table>
                            </div>
                            <!-- /.card-body -->
                          </div>
                          <!-- /.card -->
                        </div>
                      </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
          return {
            beerStyles: {}
          }
        },
        methods: {
          deleteStyle(id) {
            Swal.fire({
              title: 'Really delete this entry?',
              text: "It will be erased from the database! But you can of course re-add it :-)",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yep, let\'s delete it!'
            })
            .then((result) => {
              // delete it if ...
              if (result.value) {
                axios({
                  method: 'DELETE',
                  url: './api/beerstyle/'+id
                })
                .then( (data) => {
                  Toast.fire({
                    type: 'success',
                    title: 'Successfully deleted the item'
                  });
                  this.getBeerStyles();
                })
                .catch( () => {
                    // handle error
                    Toast.fire({
                      type: 'error',
                      title: 'Sorry, but an error ocurred and the item could not be deleted'
                    });
                });
              }
            })
          },
          getBeerStyles() {
            this.$Progress.start();
            axios.get('api/beerstyle')
              .then( ( {data} ) => {
                this.beerStyles = data.data;
                console.log(data);
              } )
              .catch(function (error) {
                // handle error
                console.log(error);
              } )
              this.$Progress.finish();
          }
        },
        created() {
          this.getBeerStyles();
        }
    }
</script>
