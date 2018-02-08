<div class="form-group">
    <div class="form-line" style="overflow-x: scroll;">
        <table id="data_suara" class="table table-bordered" style="cursor: pointer;">
            <thead>
              <tr class="bg-blue" style="color: white;">
                <th class="tg-yw4l">TPS</th>
                @for($i = 1;$i <= 22; $i++)
                  <th class="tg-yw4l">{{$i}}</th>
                @endfor
              </tr>
            </thead>
            <tbody>
                @foreach($tps_ids as $data)
                    <tr class="tg-yw4l">
                      <td>{{ $data->nomor }}</td>
                      @for($i = 1;$i <= 22; $i++)
                        <td>
                          <i class="material-icons md-icon placeholder" style="color: #BDBDBD;">photo</i>
                          <input class="hidden upload" type="file" name="images[{{ $data->id }}][]">
                        </td>
                      @endfor
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
