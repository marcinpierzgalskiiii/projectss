package com.example.ifood

import android.view.*
import android.widget.Button
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView

import kotlinx.android.synthetic.main.activity_main.view.*

 class DanieAdapter : RecyclerView.Adapter<DanieAdapter.DanieViewHolder>() {

     val CAMERA_RQ =102

     var danieList:ArrayList<Danie> = ArrayList()
    private var onClickIteam:((Danie)->Unit)? =null
    private var onClickDeleteIteam:((Danie)->Unit)? =null

    fun dodajIteams(iteams:ArrayList<Danie>){
        this.danieList = iteams
        notifyDataSetChanged()
    }

    fun setOnClickIteam(callback: (Danie)-> Unit){
        this.onClickIteam = callback

    }

    fun setOnClickDeleteIteam(callback: (Danie) -> Unit){
        this.onClickDeleteIteam = callback
    }


    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int) = DanieViewHolder(
        LayoutInflater.from(parent.context).inflate(R.layout.card_iteams_dania, parent, false)
    )

    override fun onBindViewHolder(holder: DanieViewHolder, position: Int) {
      val danie = danieList[position]
        holder.bindView(danie)
        holder.itemView.setOnClickListener{onClickIteam?.invoke(danie)}
        holder.buttonUsunDanie.setOnClickListener{onClickDeleteIteam?.invoke(danie)}


    }

    override fun getItemCount(): Int {
        return danieList.size
    }



    class DanieViewHolder( view: View):RecyclerView.ViewHolder(view){

        private var idDania = view.findViewById<TextView>(R.id.idDania)
        private var NazwaDania = view.findViewById<TextView>(R.id.NazwaDania)
        private var MiejscezZakupuDania = view.findViewById<TextView>(R.id.MiejscezZakupuDania)
        private var ocenaDania = view.findViewById<TextView>(R.id.ocenaDania)
         var buttonUsunDanie = view.findViewById<Button>(R.id.buttonUsunDanie)





        fun bindView(dania:Danie){
            idDania.text  =dania.idDania.toString()
            NazwaDania.text = dania.nazwaDania
            MiejscezZakupuDania.text =dania.miejsceZakupuDania
            ocenaDania.text = dania.ocenaDania
        }
    }
}