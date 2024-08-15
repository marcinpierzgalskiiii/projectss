package com.example.ifood

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Button
import androidx.appcompat.app.AlertDialog
import kotlinx.android.synthetic.main.activity_main.view.*
import kotlin.system.exitProcess

class MainActivity : AppCompatActivity() {

    private lateinit var buttonListaUlubionegoJedzenia: Button
    private lateinit var buttonListaUlubionychNapojow: Button
    private  lateinit var buttonListaUlubionychDeserow: Button
    private lateinit var buttonWyjdz: Button

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        val buttonListaUlubionegoJedzenia = findViewById<Button>(R.id.buttonListaUlubionegoJedzenia)

        buttonListaUlubionegoJedzenia.setOnClickListener{
            val intent = Intent(this, ListaUlubionychDan::class.java)
            startActivity(intent)
        }

        val buttonListaUlubionychDeserow = findViewById<Button>(R.id.buttonListaUlubionychDeserow)
        buttonListaUlubionychDeserow.setOnClickListener{
            val intent = Intent(this, ListaUlubionychDeserow::class.java)
            startActivity(intent)

        }

        val buttonListaUlubionychNapojow  = findViewById<Button>(R.id.buttonListaUlubionychNapojow)
        buttonListaUlubionychNapojow.setOnClickListener {
            val intent = Intent(this,ListaUlubionychNapojow::class.java)
            startActivity(intent)
        }

        val buttonWyjdz  = findViewById<Button>(R.id.buttonWyjdz)
        buttonWyjdz.setOnClickListener {
            this@MainActivity.finish()
            exitProcess(0)
        }


        initViewMain()

    }



    private fun initViewMain(){
    buttonListaUlubionegoJedzenia = findViewById(R.id.buttonListaUlubionegoJedzenia)
    buttonListaUlubionychDeserow = findViewById(R.id.buttonListaUlubionychDeserow)
    buttonListaUlubionychNapojow = findViewById(R.id.buttonListaUlubionychNapojow)
    buttonWyjdz = findViewById(R.id.buttonWyjdz)
    }
}


