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
import kotlinx.android.synthetic.main.activity_lista_ulubionych_napojow.*
import kotlinx.android.synthetic.main.card_iteams_napoje.*
import java.io.File
import java.util.*
import java.util.concurrent.ExecutorService
import java.util.concurrent.Executors

class ListaUlubionychNapojow: AppCompatActivity() {

   // val CAMERA_RQ =102
   private  lateinit var binding: ActivityMainBinding
    private  var imageCapture: ImageCapture? =null
    private lateinit var outputDirectory: File
    private lateinit var cameraExecutor: ExecutorService


    val ocenaNAPOJU = arrayOf(   "bardzoDobre", "dobre", "srednie", "brak")

    //EditText  Nazwą napoju
    private lateinit var NazwaNapoju:EditText
    //EditText  Miejsce zakupu napoju
    private lateinit var MiejsceZakupuNapoju :EditText
    private  lateinit var buttonZobaczWszystkieNapoje : Button
    private  lateinit var buttoDodajNapoj : Button
    private  lateinit var buttonEdytujNapoj : Button



    private lateinit var sqliteHelper :SQLiteHelper
    private lateinit var  recyclerViewNapojow :RecyclerView
    private  var adapter: NapojAdapter? = null
    private  var  napoju:Napoju? = null

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        binding = ActivityMainBinding.inflate(layoutInflater)

        setContentView(R.layout.activity_lista_ulubionych_napojow)

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

            buttonZdiencjeNapoju.setOnClickListener{
                zrobZdiecjeNapoju()
            }
        }

        val actionBar = supportActionBar
        actionBar!!.title = "Lista ulubionych napojów"
        actionBar.setDisplayHomeAsUpEnabled(true)

        val arrayAdapter = ArrayAdapter(this@ListaUlubionychNapojow, android.R.layout.simple_spinner_dropdown_item, ocenaNAPOJU)


        spinnerNapojow.adapter = arrayAdapter
        spinnerNapojow.onItemSelectedListener = object : AdapterView.OnItemSelectedListener{
            override fun onItemSelected(p0: AdapterView<*>?, p1: View?, p2: Int, p3: Long) {
                Toast.makeText(this@ListaUlubionychNapojow,"Wybrałeś"+ocenaNAPOJU[p2], Toast.LENGTH_SHORT).show()
            }

            override fun onNothingSelected(p0: AdapterView<*>?) {
              Toast.makeText(this@ListaUlubionychNapojow, "Niewybrałeś oceny",Toast.LENGTH_SHORT).show()
            }

        }

        initViewNapojow()
        initRecyclerViewNapojow()

        sqliteHelper =SQLiteHelper(this)
        buttoDodajNapoj.setOnClickListener{dodajNapoj()}
        buttonZobaczWszystkieNapoje.setOnClickListener{getNapoj()}
        buttonEdytujNapoj.setOnClickListener{EdytujNapoj()}

        adapter?.setOnClickIteam { Toast.makeText(this, it.nazwaNapoju, Toast.LENGTH_SHORT).show()

            NazwaNapoju.setText(it.nazwaNapoju)
            MiejsceZakupuNapoju.setText(it.miejsceZakupuNapoju)

            napoju= it
        }

        adapter?.setOnClickDeleteIteamNapoj {
            UsunNapoj(it.idNapoju)

        }


    }


    private fun getNapoj(){
        val napojuList = sqliteHelper.getAllNapoje()
        Log.e("ppp", "${napojuList.size}")

        adapter?.dodajIteams(napojuList)
    }


    private fun dodajNapoj(){


        val nazwaNapoju =  NazwaNapoju.text.toString()
        val   miejsceZakupuNapoju =   MiejsceZakupuNapoju.text.toString()

        val  ocenaNapoju = spinnerNapojow.selectedItem.toString()

        if(nazwaNapoju.isEmpty() || miejsceZakupuNapoju.isEmpty()){
            Toast.makeText(this, "Wypełnij wymagane pola" , Toast.LENGTH_SHORT).show()
        }else
        {
            val napoju = Napoju(0,nazwaNapoju = nazwaNapoju, miejsceZakupuNapoju = miejsceZakupuNapoju, ocenaNapoju = ocenaNapoju)
            val statusWprowadzaniaNapoju = sqliteHelper.insertNapoju(napoju)
            //Sprawdzenie wprowadzenych danych sukces czy nie
            if(statusWprowadzaniaNapoju>-1){
                Toast.makeText(this, "Napój dodano", Toast.LENGTH_SHORT).show()
                wyczyscEditText()
                getNapoj()
            }else{
                Toast.makeText(this, "Redkord nie zapisany", Toast.LENGTH_SHORT).show()
            }
        }
    }
    private fun EdytujNapoj(){
        val nazwaNapoju =  NazwaNapoju.text.toString()
        val   miejsceZakupuNapoju =   MiejsceZakupuNapoju.text.toString()
        val  ocenaNapoju = spinnerNapojow.selectedItem.toString()

//Sprawdzenie dla rekordu który się nie zmienił
        if(nazwaNapoju == napoju?.nazwaNapoju && miejsceZakupuNapoju == napoju?.miejsceZakupuNapoju && ocenaNapoju == napoju?.ocenaNapoju){
            Toast.makeText(this, " Ten rekord się nie zmienił", Toast.LENGTH_SHORT).show()
            return
        }

        if(napoju ==null)  return
        val napoju = Napoju(idNapoju = napoju!!.idNapoju, nazwaNapoju = nazwaNapoju, miejsceZakupuNapoju = miejsceZakupuNapoju, ocenaNapoju = ocenaNapoju)
        val status =sqliteHelper.updateNapoj(napoju)

        if(status> -1){
            wyczyscEditText()
            getNapoj()
        }else{
            Toast.makeText(this, "Nie udało się edytować napoju", Toast.LENGTH_SHORT).show()
        }
    }

    private fun UsunNapoj(idNapoju: Int){
        if(idNapoju == null) return

        val builder = AlertDialog.Builder(this)
        builder.setMessage("Czy napewno chcesz usuńąć napój?")
        builder.setCancelable(true)
        builder.setPositiveButton("Tak"){dialog,_->
            sqliteHelper.UsunNapojById(idNapoju)
            getNapoj()
            dialog.dismiss()
        }
        builder.setNegativeButton("Nie"){dialog,_->

            dialog.dismiss()
        }

        val alert = builder.create()
        alert.show()

    }

    private fun wyczyscEditText(){
        NazwaNapoju.setText("")
        MiejsceZakupuNapoju.setText("")
        NazwaNapoju.requestFocus()
    }
    private  fun initRecyclerViewNapojow(){
        recyclerViewNapojow.layoutManager = LinearLayoutManager(this)
        adapter = NapojAdapter()
        recyclerViewNapojow.adapter = adapter

    }

    private fun initViewNapojow(){
        NazwaNapoju = findViewById(R.id. NazwaNapoju)
        MiejsceZakupuNapoju  = findViewById(R.id.MiejsceZakupuNapoju)
        buttonZobaczWszystkieNapoje = findViewById(R.id.buttonZobaczWszystkieNapoje)
        buttoDodajNapoj = findViewById(R.id.buttoDodajNapoj)
        buttonEdytujNapoj = findViewById(R.id.buttonEdytujNapoj)
        recyclerViewNapojow = findViewById(R.id.recyclerViewNapojow)


    }

    private fun getOutputDirectory(): File {
        val mediaDir = externalMediaDirs.firstOrNull()?.let {mFile->
            File(mFile, resources.getString(R.string.app_name)).apply {
                mkdirs()
            }
        }
        return  if(mediaDir != null && mediaDir.exists())
            mediaDir else filesDir
    }



    private fun  zrobZdiecjeNapoju(){
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

                    Toast.makeText(this@ListaUlubionychNapojow, "$msg $savedUri", Toast.LENGTH_LONG).show()
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

                    mPriview.setSurfaceProvider(viewFinderNapojow.surfaceProvider)

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