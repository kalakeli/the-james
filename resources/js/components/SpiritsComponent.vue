<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

              <div class="row">
                        <div class="col-12">
                          <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">Wines & Spirits at The James</h3>

                              <div class="card-tools">
                                <div class="input-group input-group-sm" item="width:50px;">
                                  <router-link to="/spirit" class="nav-link">
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
                                  <th><i class="fas fa-eye" title="is the drink shown on the website?"></i></th> <!-- is it visible online? -->
                                  <th>Type of Drink</th>
                                  <th>Name</th>
                                  <th>Description</th>
                                  <th>Country</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                </tr>
                                <tr v-for="item in drinks" :key="item.id">
                                  <td>{{ item.id }}</td>
                                  <td v-if="item.flagShow==1"><span class="fa-icon yes"></span> </td>
                                  <td v-else><span class="fa-icon no"></span> </td>
                                  <td>{{ item.drinkType }}</td>
                                  <td>{{ item.drinkName }}</td>
                                  <td>{{ item.drinkDescription }}</td>
                                  <td>{{ item.country }}</td>
                                  <td>
                                    <router-link :to="`/spirit/${item.id}`">
                                      <button type="button" class="btn btn-block btn-success" name="editDrink" title="edit item">
                                        <i class="fas fa-edit"></i>
                                      </button>
                                    </router-link>
                                  </td>
                                  <td><button type="button" class="btn btn-block btn-danger" name="deleteDrink" title="delete item" @click="deleteDrink(item.id)">
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
            drinks: {}
          }
        },
        methods: {
          deleteDrink(id) {
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
                  url: './api/spirit/'+id
                })
                .then( (data) => {
                  Toast.fire({
                    type: 'success',
                    title: 'Successfully deleted the item'
                  });
                  this.getDrinks();
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
          getDrinks() {
            this.$Progress.start();
            axios.get('api/spirit')
              .then( ( {data} ) => {
                this.drinks = data.data;
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
          this.getDrinks();
        }
    }
</script>
