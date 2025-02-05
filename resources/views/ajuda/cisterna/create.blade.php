@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/ajuda') }}">Ajuda Humanitária</a></li>
            <li class="breadcrumb-item active" aria-current="page">Projeto Cisterna</li>
        </ol>
    </nav>

@endsection


@section('content')
    <div class="container border p-3 min-vh-100" style="background-color:#e9ecef;">
        <div class="row flex-fill">

            <div class="col-md-12">
                <p class="p-4 input type='text'-center"><a class='btn btn-success btn-sm' href={{ url('ajuda') }}>Voltar</a>&nbsp;              


                <div class="row">

                    <div class="table-responsive">
                        

                        <div class="row">
                            <div class="col">
                                <label>Nome</label>
                                <input class="form form-control" type="input type='text'" name="nome" id="nome">
                            </div>
                        </div>

    
        <label>Formulário de pesquisa  Caracterização Técnica
        </label>

          <input type='text'>Localização da imóvel</input type='text'>

          <input type='text'>Município : <input type='text' style={{ color: 'red', fontWeight: 'bold', fontSize: 20 }}>*</input type='text'></input type='text'>
          <View style={{ borderWidth: 1, borderColor: 'silver', borderRadius: 4 }}>
            <RNPickerSelect
              onValueChange={(value) => {
                setMunicipio(value)
                setListComunidade(value)
              }
              }
              value={municipio}
              items={dropMunicipio}
              placeholder={{ label: 'Select o Município..', value: '' }}
            />
          </View>

          <input type='text'>Comunidade : <input type='text' style={{ color: 'red', fontWeight: 'bold', fontSize: 20 }}>*</input type='text'></input type='text'>
          <View style={{ borderWidth: 1, borderColor: 'silver', borderRadius: 4 }}>
            <RNPickerSelect
              onValueChange={(value) => {
                setComunidade(value)
              }
              }
              value={comunidade}
              items={comunidades}
              placeholder={{ label: 'Select o Comunidade..', value: '' }}
            />
          </View>

          <input type='text'>Endereço Completo :</input type='text'>
          <input type='text'Input style={styles1.input} placeholder="" clearButtonMode="always" onChangeinput type='text'={setEndereco}
            maxLength={50} value={endereco} />

          <input type='text'>Localização :</input type='text'>
          <input type='text'Input style={styles1.inputRo} value={localiza} onChangeinput type='text'={setLocaliza} />
          <TouchableOpacity
            style={styles1.button}
            onPress={toggleModal}>
            <input type='text' style={styles1.buttoninput type='text'}>Atualizar Localização</input type='text'>
          </TouchableOpacity>



          <input type='text'>Dados Pessoais</input type='text'>


          <input type='text'>Nome Morador : <input type='text' style={{ color: 'red', fontWeight: 'bold', fontSize: 20 }}>*</input type='text'></input type='text'>
          <input type='text'Input style={styles1.input} keyboardType={'default'} clearButtonMode="always"
            onChangeinput type='text'={setNome} value={nome} maxLength={40} />

          <input type='text'>CPF - do Morador : <input type='text' style={{ color: 'red', fontWeight: 'bold', fontSize: 20 }}>*</input type='text'></input type='text'>

          <MaskInput
            style={styles1.input}
            value={cpf}
            onChangeinput type='text'={(masked, unmasked) => {
              setCpf(masked); // you can use the unmasked value as well
            }}
            mask={Masks.BRL_CPF}
          />


          <input type='text'>Data Nascimento : <input type='text' style={{ color: 'red', fontWeight: 'bold', fontSize: 20 }}>*</input type='text'></input type='text'>
          <MaskInput
            style={styles1.input}
            value={dtNasc}
            onChangeinput type='text'={(masked, unmasked) => {
              setDtNasc(masked); // you can use the unmasked value as well

            }}
            mask={Masks.DATE_DDMMYYYY}
          />

          {/* Telefone */}
          <input type='text'>Telefone : <input type='text' style={{ color: 'red', fontWeight: 'bold', fontSize: 20 }}>*</input type='text'></input type='text'>
          <MaskInput
            style={styles1.input}
            value={tel}
            onChangeinput type='text'={(masked, unmasked) => {
              setTel(masked); // you can use the unmasked value as well

            }}
            mask={Masks.BRL_PHONE}
          />

          <input type='text'>N Cad Único:</input type='text'>
          <input type='text'Input style={styles1.input} placeholder="" keyboardType={'default'} clearButtonMode="always"
            onChangeinput type='text'={setCadUnico} value={cadUnico} maxLength={15} />

          <input type='text'>Quantidade de pessoas que residem no imóvel : <input type='text' style={{ color: 'red', fontWeight: 'bold', fontSize: 20 }}>*</input type='text'></input type='text'>
          <input type='text'Input style={styles1.input} placeholder="" keyboardType={'numeric'}
            clearButtonMode="always" onChangeinput type='text'={setQtdPessoa}
            value={String(qtdPessoa)} maxLength={4} />



          <input type='text' >Renda familiar : <input type='text' style={{ color: 'red', fontWeight: 'bold', fontSize: 20 }}>*</input type='text'></input type='text'>
          <MaskInput
            style={styles1.input}
            value={String(renda)}
            onChangeinput type='text'={(masked, unmasked) => {
              setRenda(masked); // you can use the unmasked value as well
              //console.log(masked)

            }}
            mask={Masks.BRL_CURRENCY}
          />
          <input type='text'>Tipo de Moradia <input type='text' style={{ color: 'red', fontWeight: 'bold', fontSize: 20 }}>*</input type='text'></input type='text'>
          <View style={{ borderWidth: 1, borderColor: 'silver', borderRadius: 4 }}>
            <RNPickerSelect
              onValueChange={(value) => [setSelectedValue(value), setMoradia(value), isMoradiaOutroVisivel(value)]}
              value={moradia}
              items={data_moradia}
              placeholder={{ label: 'Tipo de Moradia..', value: '' }}
            />
          </View>

          {moradiaOutrosVisivel && (
            <>
              <input type='text'>Outros Descrever :</input type='text'>
              <input type='text'Input style={styles1.input} placeholder="" clearButtonMode="always"
                onChangeinput type='text'={setOutroMoradia} value={outroMoradia} maxLength={120} />
            </>
          )}
          <input type='text'>Caracterização do imóvel</input type='text'>


          <input type='text'>Comprimento Total do Telhado (m) : <input type='text' style={{ color: 'red', fontWeight: 'bold', fontSize: 20 }}>*</input type='text'></input type='text'>
          <input type='text'Input style={styles1.input} placeholder="" clearButtonMode="always"
            onChangeinput type='text'={(value) => { [setCompTelhado(removerVirgula(value)),
              calcAreaTotal(value)
            ] }}
            keyboardType={'decimal-pad'}
            value={String(compTelhado)} maxLength={5} />

          <input type='text'>Largura do Telhado (m) : <input type='text' style={{ color: 'red', fontWeight: 'bold', fontSize: 20 }}>*</input type='text'></input type='text'>
          <input type='text'Input style={styles1.input} placeholder="" clearButtonMode="always"
            onChangeinput type='text'={(value) => {[setLarguraCompTelhado(removerVirgula(value)),
                calcAreaTotal(value)
              ] }}
            keyboardType={'decimal-pad'}
            value={String(larguracompTelhado)} maxLength={5} />


          {/* Area total do Telhado */}
          <input type='text'>Área total do telhado (m2) : <input type='text' style={{ color: 'red', fontWeight: 'bold', fontSize: 20 }}>*</input type='text'></input type='text'>
          <input type='text'Input style={styles1.inputRo} placeholder="" clearButtonMode="always"
            onChangeinput type='text'={setAreaTotalTelhado} keyboardType={'decimal-pad'}
            value={String(areaTotalTelhado)} maxLength={5} editable={false} />

          <input type='text'>Comprimeto da testada (m) : <input type='text' style={{ color: 'red', fontWeight: 'bold', fontSize: 20 }}>*</input type='text'></input type='text'>
          <input type='text'Input style={styles1.input} placeholder="" clearButtonMode="always"
            onChangeinput type='text'={setCompTestada} keyboardType={'decimal-pad'}
            value={String(compTestada)} maxLength={5} />

          <input type='text'>Número de caídas do telhado  : <input type='text' style={{ color: 'red', fontWeight: 'bold', fontSize: 20 }}>*</input type='text'></input type='text'>
          <input type='text'Input style={styles1.input} placeholder="" clearButtonMode="always"
            onChangeinput type='text'={setNumCaidaTelhado} keyboardType={'numeric'} maxLength={2}
            value={numCaidaTelhado} />

          <input type='text'>Tipo de cobertura do imóvel:</input type='text'>
          <View style={{ borderWidth: 1, borderColor: 'silver', borderRadius: 4 }}>
            <RNPickerSelect
              onValueChange={(value) => [setSelectedValue(value), setCoberturaTelhado(value), isTpCoberturaOutroVisivel(value)]}
              value={coberturaTelhado}
              items={data_cobertura}
              placeholder={{ label: 'Tipo de Cobertura..', value: '' }}
            />
          </View>

          {tpCoberturaOutVisivel && (
            <>
              <input type='text'>Outros Descrever:</input type='text'>
              <input type='text'Input style={styles1.input} placeholder="" clearButtonMode="always"
                onChangeinput type='text'={setCobertOutros} maxLength={120}
                value={coberturaOutros} />

            </>
          )}


          <input type='text'>Dados Complementares</input type='text'>


          <input type='text'>Existe fogão a lenha?  : <input type='text' style={{ color: 'red', fontWeight: 'bold', fontSize: 20 }}>*</input type='text'></input type='text'>
          <View style={{ borderWidth: 1, borderColor: 'silver', borderRadius: 4 }}>
            <RNPickerSelect
              onValueChange={(value) => [setSelectedValue(value), setExisteFogaoLenha(value), isExistFogaoVisivel(value)]}
              value={existeFogaoLenha}
              items={[{
                "label": "Não",
                "value": "0"
              },
              {
                "label": "Sim",
                "value": "1"
              }]}
            //placeholder={{ label: 'Selecione uma Opção', value: '' }}
            />
          </View>

          {existFogaoLenhaVisivel && (
          <>
          <input type='text'>Medida do telhado desconsiderando a área do fogão à lenha(m2): <input type='text' style={{ color: 'red', fontWeight: 'bold', fontSize: 20 }}>*</input type='text'></input type='text'>
          <input type='text'Input style={styles1.input} placeholder="" keyboardType={'decimal-pad'}
            clearButtonMode="always" onChangeinput type='text'={setMedidaTelhadoAreaFogao} maxLength={5}
            value={medidaTelhadoAreaFogao} />

          <input type='text'>Testada disponível, desconsiderando a parte do fogão à lenha(m) : <input type='text' style={{ color: 'red', fontWeight: 'bold', fontSize: 20 }}>*</input type='text'></input type='text'>
          <input type='text'Input style={styles1.input} placeholder="" keyboardType={'decimal-pad'}
            clearButtonMode="always" onChangeinput type='text'={setTestadaDispParteFogao} maxLength={5}
            value={testadaDispParteFogao} />
          </>
          )}


          <input type='text'>Atendimento por caminhão Pipa ?: <input type='text' style={{ color: 'red', fontWeight: 'bold', fontSize: 20 }}>*</input type='text'></input type='text'>
          <View style={{ borderWidth: 1, borderColor: 'silver', borderRadius: 4 }}>
            <RNPickerSelect
              onValueChange={(value) => [setSelectedValue(value), setAtendPipa(value), isAtendPipaOutroVisivel(value)]}
              value={atendPipa}
              items={[{
                "label": "Não",
                "value": "0"
              },
              {
                "label": "Sim",
                "value": "1"
              },]}
              placeholder={{ label: 'Selecione uma Opção', value: '' }}
            />
          </View>

          {atendPipaOutroVisivel && (
          <>
          <input type='text'>Órgão responsável pelo atendimento com caminhão Pipa : *</input type='text'>
          <View style={{ borderWidth: 1, borderColor: 'silver', borderRadius: 4 }}>

            {/* Item CK Defesa Civil */}
            <View style={styles1.section}>
              <Checkbox style={styles1.checkbox} value={respAtDefesaCivil} onValueChange={setRespAtDefesaCivil} />
              <input type='text' style={styles1.paragraph}>Defesa Civil</input type='text'>
            </View>
            {/* Item CK Exercito */}
            <View style={styles1.section}>
              <Checkbox style={styles1.checkbox} value={respAtExercito} onValueChange={setRespAtExercito} />
              <input type='text' style={styles1.paragraph}>Exército</input type='text'>
            </View>

            {/* Item CK Particular */}
            <View style={styles1.section}>
              <Checkbox style={styles1.checkbox} value={respAtParticular} onValueChange={setRespAtParticular} />
              <input type='text' style={styles1.paragraph}>Particular</input type='text'>
            </View>

            {/* Item CK Prefeitura */}
            <View style={styles1.section}>
              <Checkbox style={styles1.checkbox} value={respAtPrefeitura} onValueChange={setRespAtPrefeitura} />
              <input type='text' style={styles1.paragraph}>Prefeitura</input type='text'>
            </View>

            {/* Item             } CK Outros */}
            <View style={styles1.section}>
              <Checkbox style={styles1.checkbox} value={respAtOutros} onValueChange={setRespAtOutros} />
              <input type='text' style={styles1.paragraph}>Outros</input type='text'>
            </View>
          </View>

          <input type='text'>Outros Descrever:</input type='text'>
          <input type='text'Input style={styles1.input} placeholder="" clearButtonMode="always"
            onChangeinput type='text'={setOutroAtendPipa} maxLength={120}
            value={outroAtendPipa} />
            </>
            )}

          <input type='text'>Identificação dos Agentes :</input type='text'>

          <input type='text'>Nome do Agente : <input type='text' style={{ color: 'red', fontWeight: 'bold', fontSize: 20 }}>*</input type='text'></input type='text'>
          <input type='text'Input style={styles1.input} placeholder="" clearButtonMode="always"
            onChangeinput type='text'={setNomeAgente} maxLength={50}
            value={nomeAgente}
          />

          <input type='text'>CPF do Agente : <input type='text' style={{ color: 'red', fontWeight: 'bold', fontSize: 20 }}>*</input type='text'></input type='text'>
          <MaskInput
            style={styles1.input}
            value={cpfAgente}
            onChangeinput type='text'={(masked, unmasked) => {
              setCpfAgente(masked); // you can use the unmasked value as well

            }}
            mask={Masks.BRL_CPF}
          />

          <input type='text'>Nome do Engenheiro responsável : <input type='text' style={{ color: 'red', fontWeight: 'bold', fontSize: 20 }}>*</input type='text'></input type='text'>
          <input type='text'Input style={styles1.input} placeholder="" clearButtonMode="always"
            onChangeinput type='text'={setNomeEng} maxLength={50}
            value={nomeEng} />

          <input type='text'>Crea do Engenheiro responsável : <input type='text' style={{ color: 'red', fontWeight: 'bold', fontSize: 20 }}>*</input type='text'></input type='text'>
          <input type='text'Input style={styles1.input} placeholder="" clearButtonMode="always"
            onChangeinput type='text'={setCreaEng} maxLength={15}
            value={creaEng} />

          <input type='text'>Observações :</input type='text'>
          <input type='text'Input style={styles1.input} placeholder="" clearButtonMode="always"
            multiline onChangeinput type='text'={setOutrObs} maxLength={120}
            value={outrObs} />

          <TouchableOpacity
            style={styles1.button}
            onPress={valida}>
            <input type='text' style={styles1.buttoninput type='text'}>{funcBotao}</input type='text'>
          </TouchableOpacity>


        </View>

        <StatusBar style="light" />

        {/* Modal renovar Lat Long */}
        <Modal isVisible={isModalVisible}>
          <View style={styles1.modalContent}>
            <input type='text'>Are you sure you want to proceed?</input type='text'>
            <Button title="Confirm" onPress={handleConfirm} />
            <Button title="Cancel" onPress={handleCancel} />
          </View>
        </Modal>


      </View>

    </ParallaxScrollView >

                        

                    </div>
                    

                </div>



            </div>
        </div>
    </div>

@stop

@section('css')
@stop

@section('code')


    <script type="input type='text'/javascript">
        $(document).ready(function() {



        })
    </script>

@endsection
