<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Wines & Spirits Component</div>

                    <div class="card-body">
                      <h2>Wines / Spirits haben</h2>
                        <ul>
                          <li>Namen</li>
                          <li>Getränketyp (Gin, Whiskey, Rotwein, Weißwein, ... was noch?)</li>
                          <li> - was soll hier stehen!? selbe Infos wie bei Bieren? also Alkohol, Geschmack,...? Das macht bei Gin oder Whiskey vielleicht Sinn, soll bei Gin zum Beispiel auch der Tonic genannt werden?  - </li>
                          <li>flagShow (müssen nicht online sein, selbst wenn das Datum stimmt)</li>
                          <li>timestamps</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
