package com.example.ifood

import android.annotation.SuppressLint
import android.content.ContentValues
import android.content.Context
import android.database.Cursor
import android.database.sqlite.SQLiteDatabase
import android.database.sqlite.SQLiteOpenHelper
import androidx.core.database.getIntOrNull
import androidx.core.database.getStringOrNull

class SQLiteHelper(context:Context): SQLiteOpenHelper(context, DATEBASE_NAME, null, DATABASE_VERSION) {


    companion object{

        private const val DATABASE_VERSION =1
        private const val DATEBASE_NAME = "ifood.db"
        //do dań
         const val TBL_Danie ="tbl_danie"
        private const val IdDania ="id"
        private const val miejsceZakupuDania = "miejsceZakupuDania"
        private const val nazwaDania = "nazwaDania"
        private const val ocenaDania = "ocenaDania"
        //do napojów
         const val TBL_Napoju ="tbl_napoj"
        private const val IdNapoju ="id"
        private const val miejsceZakupuNapoju = "miejsceZakupuNapoju"
        private const val nazwaNapoju = "nazwaNapoju"
        private const val ocenaNapoju = "ocenaNapoju"
        //do deserów
         const val TBL_Deser ="tbl_deser"
        private const val IdDeseru ="id"
        private const val miejsceZakupuDeseru = "miejsceZakupuDeseru"
        private const val nazwaDeseru = "nazwaDeseru"
        private const val ocenaDeseru = "ocenaDeseru"

    }

    override fun onCreate(p0: SQLiteDatabase?) {
        //Stworzenie tabeli dań
      val createTblDanie = (" CREATE TABLE " + TBL_Danie +"("
              + IdDania + " INTEGER PRIMARY KEY AUTOINCREMENT," +   nazwaDania + " TEXT," +
              miejsceZakupuDania + " TEXT," + ocenaDania +" TEXT" +")")
        p0?.execSQL(createTblDanie)

        //Stworzenie tabeli napojów
        val createTblNapoju= (" CREATE TABLE " + TBL_Napoju + "("
                + IdNapoju + " INTEGER PRIMARY KEY AUTOINCREMENT," + miejsceZakupuNapoju + " TEXT,"
                + nazwaNapoju + " TEXT," + ocenaNapoju +" TEXT" + ")")
        p0?.execSQL(createTblNapoju)

        //Stworzenie tabeli deserów
        val createTblDeseru= (" CREATE TABLE " + TBL_Deser +"("
                + IdDeseru + " INTEGER PRIMARY KEY AUTOINCREMENT," + miejsceZakupuDeseru + " TEXT,"
                + nazwaDeseru + " TEXT," + ocenaDeseru +" TEXT" +")")
        p0?.execSQL(createTblDeseru)
    }


    override fun onUpgrade(p0: SQLiteDatabase?, p1: Int, p2: Int) {
       p0!!.execSQL("DROP TABLE  IF EXISTS $TBL_Danie "  )
        onCreate(p0)

        p0!!.execSQL("DROP TABLE  IF EXISTS $TBL_Napoju "  )
        onCreate(p0)

        p0!!.execSQL("DROP TABLE  IF EXISTS $TBL_Deser "  )
        onCreate(p0)

    }



    fun insertDanie(dania: Danie) :Long{
        val p0 = this.writableDatabase

        val contentValues = ContentValues()
        contentValues.put(miejsceZakupuDania, dania.miejsceZakupuDania)
        contentValues.put(nazwaDania, dania.nazwaDania)
        contentValues.put(ocenaDania, dania.ocenaDania)

        val sukces = p0.insert(TBL_Danie, null, contentValues)
        p0.close()
        return sukces
    }
     fun insertNapoju(napoje: Napoju):Long{
         val p0 = this.writableDatabase

         val contentValues = ContentValues()
         contentValues.put(miejsceZakupuNapoju, napoje.miejsceZakupuNapoju)
         contentValues.put(nazwaNapoju, napoje.nazwaNapoju)
         contentValues.put(ocenaNapoju, napoje.ocenaNapoju)

         val sukces = p0.insert(TBL_Napoju, null, contentValues)
         p0.close()
         return sukces
     }
    fun insertDeser(deser:Deser):Long{
        val p0 = this.writableDatabase

        val contentValues = ContentValues()
        contentValues.put(miejsceZakupuDeseru, deser.miejsceZakupuDeseru)
        contentValues.put(nazwaDeseru, deser.nazwaDeseru)
        contentValues.put(ocenaDeseru, deser.ocenaDeseru)

        val sukces = p0.insert(TBL_Deser, null, contentValues)
        p0.close()
        return sukces
    }




    fun getAllDania():ArrayList<Danie>{
        val daniaList: ArrayList<Danie> = ArrayList()
        val selectQuery = "SELECT * FROM $TBL_Danie"
        val p0 = this.readableDatabase

        val cursor : Cursor?

        try {
            cursor =p0.rawQuery(selectQuery, null)
        }catch (e:Exception){

         e.printStackTrace()
            p0.execSQL(selectQuery)
            return  ArrayList()
        }
        var idDania:Int
        var miejsceZakupuDania:String
        var nazwaDania:String
        var ocenaDania:String

        if(cursor.moveToFirst()){
            do{

                idDania = cursor.getInt(cursor.getColumnIndexOrThrow("id"))
                miejsceZakupuDania = cursor.getString(cursor.getColumnIndexOrThrow("miejsceZakupuDania"))
               nazwaDania= cursor.getString(cursor.getColumnIndexOrThrow("nazwaDania"))
                ocenaDania = cursor.getString(cursor.getColumnIndexOrThrow("ocenaDania"))


                val dania = Danie(idDania = idDania, miejsceZakupuDania = miejsceZakupuDania, nazwaDania = nazwaDania, ocenaDania = ocenaDania)
                daniaList.add(dania)

            }while (cursor.moveToNext())
        }
        return daniaList


    }




 fun getAllNapoje():ArrayList<Napoju>{
    val napojuList: ArrayList<Napoju> = ArrayList()
    val selectQuery = "SELECT * FROM $TBL_Napoju"
    val p0 = this.readableDatabase

    val cursor : Cursor?

    try {
        cursor =p0.rawQuery(selectQuery, null)
    }catch (e:Exception){

        e.printStackTrace()
        p0.execSQL(selectQuery)
        return  ArrayList()
    }

    var idNapoju:Int
    var miejsceZakupuNapoju:String
    var nazwaNapoju:String
    var ocenaNapoju:String

    if(cursor.moveToFirst()){
        do{
            idNapoju = cursor.getInt(cursor.getColumnIndexOrThrow("id"))
            miejsceZakupuNapoju = cursor.getString(cursor.getColumnIndexOrThrow("miejsceZakupuNapoju"))
            nazwaNapoju= cursor.getString(cursor.getColumnIndexOrThrow("nazwaNapoju"))
            ocenaNapoju = cursor.getString(cursor.getColumnIndexOrThrow("ocenaNapoju"))

            val napoju = Napoju(idNapoju = idNapoju, miejsceZakupuNapoju = miejsceZakupuNapoju, nazwaNapoju = nazwaNapoju, ocenaNapoju = ocenaNapoju)
            napojuList.add(napoju)

        }while (cursor.moveToNext())
    }
    return napojuList


}




    fun getAllDesery():ArrayList<Deser>{
        val deserList: ArrayList<Deser> = ArrayList()
        val selectQuery = "SELECT * FROM $TBL_Deser"
        val p0 = this.readableDatabase

        val cursor : Cursor?

        try {
            cursor =p0.rawQuery(selectQuery, null)
        }catch (e:Exception){

            e.printStackTrace()
            p0.execSQL(selectQuery)
            return  ArrayList()
        }

        var idDeseru:Int
        var miejsceZakupuDeseru:String
        var nazwaDeseru:String
        var ocenaDeseru:String

        if(cursor.moveToFirst()){
            do{
                idDeseru = cursor.getInt(cursor.getColumnIndexOrThrow("id"))
                miejsceZakupuDeseru = cursor.getString(cursor.getColumnIndexOrThrow("miejsceZakupuDeseru"))
                nazwaDeseru= cursor.getString(cursor.getColumnIndexOrThrow("nazwaDeseru"))
                ocenaDeseru = cursor.getString(cursor.getColumnIndexOrThrow("ocenaDeseru"))

                val deser = Deser(idDeseru = idDeseru, miejsceZakupuDeseru = miejsceZakupuDeseru, nazwaDeseru = nazwaDeseru, ocenaDeseru = ocenaDeseru)
                deserList.add(deser)

            }while (cursor.moveToNext())
        }
        return deserList


    }


    fun updateDanie(dania: Danie): Int{

        val p0 = this.writableDatabase
        val contentValues = ContentValues()

        contentValues.put(IdDania, dania.idDania)
        contentValues.put(miejsceZakupuDania, dania.miejsceZakupuDania)
        contentValues.put(nazwaDania, dania.nazwaDania)
        contentValues.put(ocenaDania, dania.ocenaDania)

        val success =p0.update(TBL_Danie, contentValues, "id="+dania.idDania, null)
        p0.close()
        return success
    }
    fun updateNapoj(napoju: Napoju): Int{

        val p0 = this.writableDatabase
        val contentValues = ContentValues()

        contentValues.put(IdNapoju, napoju.idNapoju)
        contentValues.put(miejsceZakupuNapoju, napoju.miejsceZakupuNapoju)
        contentValues.put(nazwaNapoju, napoju.nazwaNapoju)
        contentValues.put(ocenaNapoju, napoju.ocenaNapoju)

        val success =p0.update(TBL_Napoju, contentValues, "id=" +napoju.idNapoju, null)
        p0.close()
        return success
    }
    fun updateDeseru(deser:Deser): Int{

        val p0 = this.writableDatabase
        val contentValues = ContentValues()

        contentValues.put( IdDeseru, deser.idDeseru)
        contentValues.put(miejsceZakupuDeseru, deser.miejsceZakupuDeseru)
        contentValues.put(nazwaDeseru, deser.nazwaDeseru)
        contentValues.put(ocenaDeseru, deser.ocenaDeseru)

        val success =p0.update(TBL_Deser, contentValues, "id="+deser.idDeseru, null)
        p0.close()
        return success
    }

    fun UsunDaniById(idDania: Int): Int{
        val p0 = this.writableDatabase

        val contentValues = ContentValues()
        contentValues.put(IdDania, idDania)

        val success = p0.delete(TBL_Danie, "id=" +idDania, null)
        p0.close()
        return success
    }

    fun UsunDeserById(idDeseru: Int): Int{
        val p0 = this.writableDatabase

        val contentValues = ContentValues()
        contentValues.put(IdDeseru, idDeseru)

        val success = p0.delete(TBL_Deser, "id=" +idDeseru, null)
        p0.close()
        return success
    }

    fun UsunNapojById(idNapoju: Int): Int{
        val p0 = this.writableDatabase

        val contentValues = ContentValues()
        contentValues.put(IdNapoju, idNapoju)

        val success = p0.delete(TBL_Napoju, "id=" +idNapoju, null)
        p0.close()
        return success
    }

}