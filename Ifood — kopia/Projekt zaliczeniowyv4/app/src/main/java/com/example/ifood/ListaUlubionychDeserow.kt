package com.example.ifood

import android.content.Intent
import android.content.pm.PackageManager
import android.graphics.Bitmap
import android.icu.text.SimpleDateFormat
import android.net.Uri
import android.os.Build
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.provider.MediaStore
import android.util.Log
import android.view.View
import android.widget.*
import androidx.activity.result.contract.ActivityResultContracts
import androidx.appcompat.app.AlertDialog
import androidx.camera.core.CameraSelector
import androidx.camera.core.ImageCapture
import androidx.camera.core.Preview
import androidx.camera.lifecycle.ProcessCameraProvider
import androidx.core.app.ActivityCompat
import androidx.core.content.ContextCompat
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.example.ifood.databinding.ActivityMainBinding
import kotlinx.android.synthetic.main.activity_lista_ulubionych_dan.*
import kotlinx.android.synthetic.main.activity_lista_ulubionych_deserow.*
import kotlinx.android.synthetic.main.card_iteams_desery.*
import java.io.File
import java.util.*
import java.util.concurrent.ExecutorService
import java.util.concurrent.Executors

class ListaUlubionychDeserow: AppCompatActivity() {

    //val CAMERA_RQ =102
    private  lateinit var binding: ActivityMainBinding
    private  var imageCapture: ImageCapture? =null
    private lateinit var outputDirectory: File
    private lateinit var cameraExecutor: ExecutorService

    val ocenaDESERU = arrayOf(   "bardzoDobre", "dobre", "srednie", "brak")

    //EditText  Nazwą dania
    private lateinit var NazwaDeseru :EditText
    //EditText  Miejsce zakupu deseru
    private lateinit var MiejsceZakupuDeseru :EditText
    private  lateinit var buttonZobaczWszystkieDesery: Button
    private  lateinit var buttonDodajDeser: Button
    private  lateinit var buttonEdytujDeser: Button



    private lateinit var sqliteHelper :SQLiteHelper
    private lateinit var recyclerViewDeserow :RecyclerView
    private  var adapter: DeserAdapter? = null
    private  var  deser:Deser? = null


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        binding = ActivityMainBinding.inflate(layoutInflater)

        setContentView(R.layout.activity_lista_ulubionych_deserow)

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

            buttonZdiencjeDeseru.setOnClickListener{
                zrobZdiecjeDeseru()
            }
        }

        val actionBar = supportActionBar
        actionBar!!.title = "Lista ulubionych deserów"
        actionBar.setDisplayHomeAsUpEnabled(true)

        val arrayAdapter = ArrayAdapter(this@ListaUlubionychDeserow, android.R.layout.simple_spinner_dropdown_item, ocenaDESERU)



        spinnerDeserow.adapter = arrayAdapter
        spinnerDeserow.onItemSelectedListener = object : AdapterView.OnItemSelectedListener{
            override fun onItemSelected(p0: AdapterView<*>?, p1: View?, p2: Int, p3: Long) {
                Toast.makeText(this@ListaUlubionychDeserow,"Wybrałeś"+ocenaDESERU[p2], Toast.LENGTH_SHORT).show()
            }

            override fun onNothingSelected(p0: AdapterView<*>?) {
                Toast.makeText(this@ListaUlubionychDeserow, "Niewybrałeś oceny",Toast.LENGTH_SHORT).show()
            }

        }

        initViewDeserow()
        initRecyclerViewDeserow()
        sqliteHelper =SQLiteHelper(this)
        buttonDodajDeser.setOnClickListener{dodajDeser()}
        buttonZobaczWszystkieDesery.setOnClickListener{getDeser()}
        buttonEdytujDeser.setOnClickListener{EdytujDeser()}

        adapter?.setOnClickIteam { Toast.makeText(this, it.nazwaDeseru, Toast.LENGTH_SHORT).show()

            NazwaDeseru.setText(it.nazwaDeseru)
            MiejsceZakupuDeseru.setText(it.miejsceZakupuDeseru)
            deser= it
        }

        adapter?.setOnClickDeleteIteamDeser {
            UsunDeser(it.idDeseru)

        }

    }
    private fun getDeser(){
        val deserList = sqliteHelper.getAllDesery()
        Log.e("ppp", "${deserList.size}")

        adapter?.dodajIteams(deserList)
    }

    private fun dodajDeser(){


        val nazwaDeseru =  NazwaDeseru.text.toString()
        val  miejsceZakupuDeseru =   MiejsceZakupuDeseru.text.toString()
        val  ocenaDeseru = spinnerDeserow.selectedItem.toString()


        if(nazwaDeseru.isEmpty() || miejsceZakupuDeseru.isEmpty()){
            Toast.makeText(this, "Wypełnij wymagane pola" , Toast.LENGTH_SHORT).show()
        }else
        {
            val deseru = Deser(0, nazwaDeseru = nazwaDeseru, miejsceZakupuDeseru = miejsceZakupuDeseru, ocenaDeseru = ocenaDeseru)
            val statusWprowadzaniaDeseru = sqliteHelper.insertDeser(deseru)
            //Sprawdzenie wprowadzenych danych sukces czy nie
            if(statusWprowadzaniaDeseru>-1){
                Toast.makeText(this, "Napój deser", Toast.LENGTH_SHORT).show()
                wyczyscEditText()
                getDeser()
            }else{
                Toast.makeText(this, "Redkord nie zapisany", Toast.LENGTH_SHORT).show()
            }
        }
    }

    private fun EdytujDeser(){
        val nazwaDeseru =  NazwaDeseru.text.toString()
        val  miejsceZakupuDeseru =   MiejsceZakupuDeseru.text.toString()
        val  ocenaDeseru = spinnerDeserow.selectedItem.toString()
//Sprawdzenie dla rekordu który się nie zmienił
        if(nazwaDeseru == deser?.nazwaDeseru && miejsceZakupuDeseru == deser?.miejsceZakupuDeseru && ocenaDeseru == deser?.ocenaDeseru){
            Toast.makeText(this, " Ten rekord się nie zmienił", Toast.LENGTH_SHORT).show()
            return
        }

        if(deser ==null)  return
        val deser = Deser(idDeseru = deser!!.idDeseru, nazwaDeseru = nazwaDeseru, miejsceZakupuDeseru = miejsceZakupuDeseru, ocenaDeseru = ocenaDeseru)
        val status =sqliteHelper.updateDeseru(deser)

        if(status> -1){
            wyczyscEditText()
            getDeser()
        }else{
            Toast.makeText(this, "Nie udało się edytować deseru", Toast.LENGTH_SHORT).show()
        }
    }
    private fun UsunDeser(idDeseru: Int){
        if(idDeseru == null) return

        val builder = AlertDialog.Builder(this)
        builder.setMessage("Czy napewno chcesz usuńąć deser?")
        builder.setCancelable(true)
        builder.setPositiveButton("Tak"){dialog,_->
            sqliteHelper.UsunDeserById(idDeseru)
            getDeser()
            dialog.dismiss()
        }
        builder.setNegativeButton("Nie"){dialog,_->

            dialog.dismiss()
        }

        val alert = builder.create()
        alert.show()


    }

    private fun wyczyscEditText(){
        NazwaDeseru.setText("")
        MiejsceZakupuDeseru.setText("")
        NazwaDeseru.requestFocus()
    }
    private  fun initRecyclerViewDeserow(){
        recyclerViewDeserow.layoutManager = LinearLayoutManager(this)
        adapter = DeserAdapter()
        recyclerViewDeserow.adapter = adapter

    }

    private fun initViewDeserow()
    {
        NazwaDeseru = findViewById(R.id. NazwaDeseru)
        MiejsceZakupuDeseru  = findViewById(R.id.MiejsceZakupuDeseru)
        buttonZobaczWszystkieDesery = findViewById(R.id.buttonZobaczWszystkieDesery)
        buttonDodajDeser = findViewById(R.id. buttonDodajDeser)
        buttonEdytujDeser = findViewById(R.id. buttonEdytujDeser)
        recyclerViewDeserow = findViewById(R.id.recyclerViewDeserow)


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



    private fun  zrobZdiecjeDeseru(){
        val imageCapture = imageCapture?:return
        val photoFile =   File(
            outputDirectory,
            SimpleDateFormat(Constants.FILE_NAME_FORMAT, Locale.getDefault()).format(System.currentTimeMillis())+ ".jpg")
        val outputOption = ImageCapture.OutputFileOptions.Builder(photoFile).build()

        imageCapture.takePicture(
            outputOption, ContextCompat.getMainExecutor(this),
            object : ImageCapture.OnImageCapturedCallback(), ImageCapture.OnImageSavedCallback {
                override fun onImageSaved(outputFileResults: ImageCapture.OutputFileResults) {
                    val savedUri = Uri.fromFile(photoFile)
                    val msg = "Zdięcje zapisano"

                    Toast.makeText(this@ListaUlubionychDeserow, "$msg $savedUri", Toast.LENGTH_LONG).show()
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

                    mPriview.setSurfaceProvider(viewFinderDeserow.surfaceProvider)

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
                Log.d(Constants.TAG, "startCamera miepowodzenie:", e)
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

    override fun onDestroy() {
        super.onDestroy()
        cameraExecutor.shutdown()
    }




}