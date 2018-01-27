<div class="form-group">
    <div class="form-line" style="overflow-x: scroll;">
        <table id="data_suara" class="table table-bordered" style="cursor: pointer;">
            <thead>
              <tr class="bg-blue" style="color: white;">
                <th class="tg-yw4l">Calon</th>
                @foreach($tps as $data)
                    <th class="tg-yw4l">X{{ $data }}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @if($calon)
                @foreach($calon as $data_calon)
                  <tr>
                    <td class="tg-yw4l" tabindex="1">
                      {{ $data_calon->nama }}
                    </td>
                    @foreach($tps as $data)
                        <td class="tg-yw4l" tabindex="1">
                          <input name="tabulasi[{{ $data_calon->id }}][{{ $data }}]" type="number" style="border:none" value="0">
                        </td>
                    @endforeach
                  </tr>
                @endforeach
              @endif
            </tbody>

        </table>
    </div>
</div>
