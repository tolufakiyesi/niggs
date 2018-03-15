

             <?= form_open_multipart('journal/test') ?>
            <div class="form-group">
                <label for="journalfile">Upload</label>
                <input type="file" class="form-control" id="journalfile" name="journalfile" accept=".pdf, .doc, .docx" >
                <p class="help-block">Not larger than 30mb</p>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-default" value="Login">
            </div>
            </form>

