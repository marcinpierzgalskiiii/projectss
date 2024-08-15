package com.example.ifood

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Button
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView

class NapojAdapter: RecyclerView.Adapter<NapojAdapter.NapojViewHolder>() {
    private var napojuList:ArrayList<Napoju> = ArrayList()
    private var onClickIteam:((Napoju)->Unit)? =null
    private var onClickDeleteIteamNapoj:((Napoju)->Unit)? =null

    fun dodajIteams(iteams:ArrayList<Napoju>){
        this.napojuList = iteams
        notifyDataSetChanged()
    }

    fun setOnClickIteam(callback: (Napoju)-> Unit){
        this.onClickIteam = callback
    }

    fun setOnClickDeleteIteamNapoj(callback: (Napoju) -> Unit){
        this.onClickDeleteIteamNapoj = callback
    }


    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int)= NapojAdapter.NapojViewHolder(
        LayoutInflater.from(parent.context).inflate(R.layout.card_iteams_napoje, parent, false)
    )
    override fun onBindViewHolder(holder: NapojViewHolder, position: Int) {
        val napoju = napojuList[position]
        holder.bindView(napoju)
        holder.itemView.setOnClickListener{onClickIteam?.invoke(napoju)}
        holder.buttonUsunNapoj.setOnClickListener{onClickDeleteIteamNapoj?.invoke(napoju)}
    }

    override fun getItemCount(): Int {
        return napojuList.size
    }

    class NapojViewHolder(var view: View):RecyclerView.ViewHolder(view){

        private var idNapoju = view.findViewById<TextView>(R.id.idNapoju)
        private var NazwaNapoju = view.findViewById<TextView>(R.id.NazwaNapoju)
        private var MiejsceZakupuNapoju = view.findViewById<TextView>(R.id.MiejsceZakupuNapoju)
        private var ocenaNapoju = view.findViewById<TextView>(R.id.ocenaNapoju)
         var buttonUsunNapoj = view.findViewById<Button>(R.id.buttonUsunNapoj)


        fun bindView(napoje: Napoju){
            idNapoju.text  =napoje.idNapoju.toString()
            NazwaNapoju.text = napoje.nazwaNapoju
            MiejsceZakupuNapoju.text =napoje.miejsceZakupuNapoju
            ocenaNapoju.text = napoje.ocenaNapoju
        }
    }

}