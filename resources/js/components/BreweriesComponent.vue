<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

              <div class="row">
                        <div class="col-12">
                          <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">Breweries available at The James</h3>

                              <div class="card-tools">
                                <div class="input-group input-group-sm" item="width:50px;">
                                  <router-link to="/brewery" class="nav-link">
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
                                  <th>Brewery</th>
                                  <th>Brewery (full name)</th>
                                  <th>Address</th>
                                  <th>Website</th>
                                  <th>Country</th>
                                  <th>Region</th>
                                  <th>Regional Tourist Information Website</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                </tr>
                                <tr v-for="item in breweries" :key="item.id">
                                  <td>{{ item.id }}</td>
                                  <td>{{ item.brewery }}</td>
                                  <td>{{ item.breweryLong }}</td>
                                  <td>{{ item.breweryAddress }}</td>
                                  <td>{{ item.breweryUrl }}</td>
                                  <td>{{ item.country }}</td>
                                  <td>{{ item.region }}</td>
                                  <td>{{ item.regionalInformation }}</td>
                                  <td>
                                    <router-link :to="`/brewery/${item.id}`">
                                      <button type="button" class="btn btn-block btn-success" name="editBrewery" title="edit item">
                                        <i class="fas fa-edit"></i>
                                      </button>
                                    </router-link>
                                  </td>
                                  <td><button type="button" class="btn btn-block btn-danger" name="deleteBrewery" title="delete item" @click="deleteBrewery(item.id)">
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
            breweries: {}
          }
        },
        methods: {
          deleteBrewery(id) {
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
              if (result.value) {
                axios({
                  method: 'DELETE',
                  url: './api/brewery/'+id
                })
                .then( (data) => {
                  Toast.fire({
                    type: 'success',
                    title: 'Successfully deleted the item'
                  });
                  this.getBreweries();
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
          getBreweries() {
            this.$Progress.start();
            axios.get('api/brewery  ')
              .then( ( {data} ) => {
                this.breweries = data.data;
                console.log(data.data);
              } )
              .catch(function (error) {
                // handle error
                console.log(error);
              } )
              this.$Progress.finish();
          }
        },
        created() {
          this.getBreweries();
        }
    }
</script>
