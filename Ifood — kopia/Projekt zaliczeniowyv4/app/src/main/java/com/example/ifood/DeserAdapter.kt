package com.example.ifood

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Button
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView

class DeserAdapter:RecyclerView.Adapter<DeserAdapter.DeserViewHolder>() {
    private var deserList:ArrayList<Deser> = ArrayList()
    private var onClickIteam:((Deser)->Unit)? =null
    private var onClickDeleteIteamDeser:((Deser)->Unit)? =null

    fun dodajIteams(iteams:ArrayList<Deser>){
        this.deserList = iteams
        notifyDataSetChanged()
    }

    fun setOnClickIteam(callback: (Deser)-> Unit){
        this.onClickIteam = callback
    }

    fun setOnClickDeleteIteamDeser(callback: (Deser) -> Unit){
        this.onClickDeleteIteamDeser = callback
    }



    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int)= DeserAdapter.DeserViewHolder(
        LayoutInflater.from(parent.context).inflate(R.layout.card_iteams_desery, parent, false)
    )

    override fun onBindViewHolder(holder: DeserViewHolder, position: Int) {
        val deser = deserList[position]
        holder.bindView(deser)
        holder.itemView.setOnClickListener{onClickIteam?.invoke(deser)}
        holder.buttonUsunDeser.setOnClickListener{onClickDeleteIteamDeser?.invoke(deser)}
    }

    override fun getItemCount(): Int {
        return deserList.size
    }

    class DeserViewHolder(var view: View): RecyclerView.ViewHolder(view){

        private var  idDeseru = view.findViewById<TextView>(R.id. idDeseru)
        private var NazwaDeseru = view.findViewById<TextView>(R.id.NazwaDeseru)
        private var MiejsceZakupuDeseru = view.findViewById<TextView>(R.id.MiejsceZakupuDeseru)
        private var ocenaDeseru = view.findViewById<TextView>(R.id.ocenaDeseru)
         var buttonUsunDeser = view.findViewById<Button>(R.id.buttonUsunDeser)


        fun bindView(deser:Deser){
            idDeseru.text  =deser. idDeseru.toString()
            NazwaDeseru.text = deser.nazwaDeseru
            MiejsceZakupuDeseru.text =deser.miejsceZakupuDeseru
            ocenaDeseru.text = deser.ocenaDeseru
        }
    }
}