package com.example.ifood

import android.annotation.SuppressLint
import android.content.ContentResolver
import android.content.ContentValues
import android.content.Intent
import android.content.pm.PackageManager
import android.graphics.Bitmap
import android.icu.text.SimpleDateFormat
import android.net.Uri
import android.os.Build
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.provider.MediaStore
import android.provider.Settings
import android.util.Log
import android.view.LayoutInflater
import android.view.TextureView
import android.view.View
import android.widget.*
import android.widget.ImageView
import androidx.activity.result.contract.ActivityResultContracts
import androidx.appcompat.app.AlertDialog
import androidx.camera.core.*
import androidx.camera.lifecycle.ProcessCameraProvider
import androidx.core.app.ActivityCompat
import androidx.core.content.ContextCompat
import androidx.core.view.contains
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.example.ifood.Constants.TAG

import com.example.ifood.databinding.ActivityListaUlubionychDanBinding
import com.example.ifood.databinding.ActivityMainBinding
import kotlinx.android.synthetic.main.activity_lista_ulubionych_dan.*
import kotlinx.android.synthetic.main.activity_lista_ulubionych_deserow.*
import kotlinx.android.synthetic.main.card_iteams_dania.*
import java.io.File
import java.util.*
import java.util.concurrent.Executor
import java.util.concurrent.ExecutorService
import java.util.concurrent.Executors
import java.util.jar.Manifest
import kotlin.math.log


class ListaUlubionychDan: AppCompatActivity() {


    //val CAMERA_RQ =102
    private  lateinit var binding: ActivityListaUlubionychDanBinding
    private  var imageCapture: ImageCapture? =null
    private lateinit var outputDirectory: File
    private lateinit var cameraExecutor: ExecutorService


        private lateinit var NazwaDania :EditText
        //EditText  Miejsce zakupu dania
        private lateinit var MiejscezZakupuDania :EditText
        //Przycisk do wyświetlenia wszystkich dań
        private  lateinit var buttonZobaczWszystkieDania : Button
        //Przycisk do dodawania
        private  lateinit var buttonDodajDanie : Button
        //Przycisk do edycji
        private  lateinit var buttonEdytujDanie : Button




        private lateinit var sqliteHelper :SQLiteHelper
        private  lateinit var  recyclerViewDan: RecyclerView
        private  var adapter: DanieAdapter? = null
        private  var  dania:Danie? = null

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        binding = ActivityListaUlubionychDanBinding.inflate(layoutInflater)

        setContentView(R.layout.activity_lista_ulubionych_dan)

       outputDirectory = getOutputDirectory()
        cameraExecutor = Executors.newSingleThreadExecutor()


         if(allPermissionGranted()){

             startCamera()
         }
        else{
            ActivityCompat.requestPermissions(
                this, Constants.REQUIRED_PERMISSIONS,
                Constants.REQUEST_CODE_PERMISSIONS
            )

           binding.zrobZdiecje.setOnClickListener{

                 zrobZdiecjeDania()
             }
         }


        val actionBar = supportActionBar
        actionBar!!.title = "Lista ulubionych dań"
        actionBar.setDisplayHomeAsUpEnabled(true)

        val ocenaDANIA = listOf(   "bardzoDobre", "dobre", "srednie", "brak")



        val adapterArray = ArrayAdapter<String>(this@ListaUlubionychDan, android.R.layout.simple_spinner_dropdown_item, ocenaDANIA

        )

        spinnerDan.adapter = adapterArray
        spinnerDan.onItemSelectedListener = object : AdapterView.OnItemSelectedListener{



            override fun onNothingSelected(p0: AdapterView<*>?) {
                Toast.makeText(this@ListaUlubionychDan, "Niewybrałeś oceny",Toast.LENGTH_SHORT).show()
            }
            override fun onItemSelected(AdapterView: AdapterView<*>?, p1: View?, p2: Int, p3: Long) {
                Toast.makeText(this@ListaUlubionychDan,"Wybrałeś ${AdapterView?.getItemAtPosition(p2).toString()}",Toast.LENGTH_SHORT).show()
            }


        }

        initViewDan()
        initRecyclerViewDan()
        sqliteHelper = SQLiteHelper(this)

        buttonDodajDanie.setOnClickListener{dodajDanie() }
        buttonZobaczWszystkieDania.setOnClickListener{getDanie()}
        buttonEdytujDanie.setOnClickListener{EdytujDanie()}

        adapter?.setOnClickIteam { Toast.makeText(this, it.nazwaDania, Toast.LENGTH_SHORT).show()

            NazwaDania.setText(it.nazwaDania)
            MiejscezZakupuDania.setText(it.miejsceZakupuDania)

            dania= it

        }

           adapter?.setOnClickDeleteIteam {
               UsunDanie(it.idDania)

           }

    }

    private fun getDanie(){
     val daniaList = sqliteHelper.getAllDania()
        Log.e("ppp", "${daniaList.size}")

        adapter?.dodajIteams(daniaList)


    }

    private fun dodajDanie(){

        val nazwaDania =  NazwaDania.text.toString()
        val  miejscezZakupuDania =  MiejscezZakupuDania.text.toString()
        val  ocenaDania = spinnerDan.selectedItem.toString()

        if(nazwaDania.isEmpty() || miejscezZakupuDania.isEmpty()){
            Toast.makeText(this, "Wypełnij wymagane pola" ,Toast.LENGTH_SHORT).show()
        }else
        {
           val dania = Danie(0, nazwaDania = nazwaDania, miejsceZakupuDania = miejscezZakupuDania, ocenaDania = ocenaDania)
            val statusWprowadzaniaDania = sqliteHelper.insertDanie(dania)
            //Sprawdzenie wprowadzenych danych sukces czy nie
            if(statusWprowadzaniaDania>-1){
                Toast.makeText(this, "Danie dodano", Toast.LENGTH_SHORT).show()
                wyczyscEditText()
                getDanie()


            }else{
              Toast.makeText(this, "Redkord nie zapisany", Toast.LENGTH_SHORT).show()
            }
        }
    }

    private fun EdytujDanie(){
        val nazwaDania =  NazwaDania.text.toString()
        val  miejscezZakupuDania =  MiejscezZakupuDania.text.toString()

        val  ocenaDania = spinnerDan.selectedItem.toString()
//Sprawdzenie dla rekordu który się nie zmienił
        if(nazwaDania == dania?.nazwaDania && miejscezZakupuDania == dania?.miejsceZakupuDania && ocenaDania == dania?.ocenaDania){
            Toast.makeText(this, " Ten rekord się nie zmienił", Toast.LENGTH_SHORT).show()
            return
        }

         if(dania ==null)  return
             val dania = Danie(idDania = dania!!.idDania, nazwaDania = nazwaDania, miejsceZakupuDania = miejscezZakupuDania, ocenaDania = ocenaDania)
             val status =sqliteHelper.updateDanie(dania)

        if(status> -1){
            wyczyscEditText()
            getDanie()
        }else{
            Toast.makeText(this, "Nie udało się edytować dania", Toast.LENGTH_SHORT).show()
        }
    }

    private fun UsunDanie(idDania: Int){
        if(idDania == null) return

        val builder = AlertDialog.Builder(this)
        builder.setMessage("Czy napewno chcesz usuńąć danie?")
        builder.setCancelable(true)
        builder.setPositiveButton("Tak"){dialog,_->
            sqliteHelper.UsunDaniById(idDania)
            getDanie()
            dialog.dismiss()
        }
        builder.setNegativeButton("Nie"){dialog,_->

            dialog.dismiss()
        }

        val alert = builder.create()
        alert.show()

    }

    private fun wyczyscEditText(){
        NazwaDania.setText("")
        MiejscezZakupuDania.setText("")


        NazwaDania.requestFocus()
    }

    private  fun initRecyclerViewDan(){
        recyclerViewDan.layoutManager = LinearLayoutManager(this)
        adapter = DanieAdapter()
        recyclerViewDan.adapter = adapter

    }

    private fun  initViewDan(){

        NazwaDania = findViewById(R.id.NazwaDania)
        MiejscezZakupuDania = findViewById(R.id.MiejscezZakupuDania)
        buttonZobaczWszystkieDania = findViewById(R.id.buttonZobaczWszystkieDania)
        buttonDodajDanie = findViewById(R.id.buttonDodajDanie)
        buttonEdytujDanie = findViewById(R.id.buttonEdytujDanie)
        recyclerViewDan = findViewById(R.id.recyclerViewDan)

    }

    private fun getOutputDirectory(): File{
        val mediaDir = externalMediaDirs.firstOrNull()?.let {mFile->
            File(mFile, resources.getString(R.string.app_name)).apply {
                mkdirs()
            }
        }
        return  if(mediaDir != null && mediaDir.exists())
            mediaDir else filesDir
    }



    /*private fun  zrobZdiecjeDania(){
        val imageCapture = imageCapture?:return
        val photoFile =   File(
            outputDirectory,
            SimpleDateFormat(Constants.FILE_NAME_FORMAT, Locale.getDefault()).format(System.currentTimeMillis())+".jpg")
         val outputOption = ImageCapture.OutputFileOptions.Builder(photoFile).build()

        imageCapture.takePicture(
            outputOption, ContextCompat.getMainExecutor(this),
            object : ImageCapture.OnImageCapturedCallback(), ImageCapture.OnImageSavedCallback {
                override fun onImageSaved(outputFileResults: ImageCapture.OutputFileResults) {
                  val savedUri = Uri.fromFile(photoFile)
                    val msg = "Zdięcje zapisano"

                    Toast.makeText(this@ListaUlubionychDan, "$msg $savedUri", Toast.LENGTH_LONG).show()
                }


            }
        )
    }*/

    private fun  zrobZdiecjeDania(){
        // Get a stable reference of the modifiable image capture use case
        val imageCapture = imageCapture ?: return

        // Create time stamped name and MediaStore entry.
        val name = SimpleDateFormat(Constants.FILE_NAME_FORMAT, Locale.US)
            .format(System.currentTimeMillis())
        val contentValues = ContentValues().apply {
            put(MediaStore.MediaColumns.DISPLAY_NAME, name)
            put(MediaStore.MediaColumns.MIME_TYPE, "image/jpeg")
            if(Build.VERSION.SDK_INT > Build.VERSION_CODES.P) {
                put(MediaStore.Images.Media.RELATIVE_PATH, "Pictures/CameraX-Image")
            }
        }

        // Create output options object which contains file + metadata
        val outputOptions = ImageCapture.OutputFileOptions
            .Builder(contentResolver,
                MediaStore.Images.Media.EXTERNAL_CONTENT_URI,
                contentValues)
            .build()

        // Set up image capture listener, which is triggered after photo has
        // been taken
        imageCapture.takePicture(
            outputOptions,
            ContextCompat.getMainExecutor(this),
            object : ImageCapture.OnImageSavedCallback {
                override fun onError(exc: ImageCaptureException) {
                    Log.e(TAG, "Photo capture failed: ${exc.message}", exc)
                }

                override fun
                        onImageSaved(output: ImageCapture.OutputFileResults){
                    val msg = "Photo capture succeeded: ${output.savedUri}"
                    Toast.makeText(baseContext, msg, Toast.LENGTH_SHORT).show()
                    Log.d(TAG, msg)
                }
            }
        )
    }



    private fun startCamera(){
        val cameraProviderFuture = ProcessCameraProvider.getInstance(this)

        cameraProviderFuture.addListener({
            val cameraProvider: ProcessCameraProvider = cameraProviderFuture.get()

            val preview = Preview.Builder()
                .build()
                .also {
                    mPriview ->

                    mPriview.setSurfaceProvider(viewFinder.surfaceProvider)

                }

            imageCapture = ImageCapture.Builder()
                .build()
            val cameraSelector = CameraSelector.DEFAULT_BACK_CAMERA

            try{
                cameraProvider.unbindAll()

                cameraProvider.bindToLifecycle(
                    this, cameraSelector, preview, imageCapture
                )

            }catch (e:Exception){
                Log.d(TAG, "startCamera miepowodzenie:", e)
            }
        }, ContextCompat.getMainExecutor(this))
    }

    override fun onRequestPermissionsResult(
        requestCode: Int,
        permissions: Array< String>,
        grantResults: IntArray
    ) {
        //musiałem dodać super bo błąd
        super.onRequestPermissionsResult(requestCode, permissions, grantResults)
        if(requestCode == Constants.REQUEST_CODE_PERMISSIONS){
            if(allPermissionGranted()){
             startCamera()
            }
            else{
                Toast.makeText(this,"Nie uzyskano pozwolenia od użytkownika", Toast.LENGTH_LONG).show()

                finish()
            }
        }
    }

    private fun allPermissionGranted()=
        Constants.REQUIRED_PERMISSIONS.all {
            ContextCompat.checkSelfPermission(baseContext, it
            ) == PackageManager.PERMISSION_GRANTED
        }

    override  fun onDestroy() {

        super.onDestroy()
        cameraExecutor.shutdown()
    }


}




